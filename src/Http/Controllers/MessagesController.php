<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\MessageDataTable;
use Teamtnt\SalesManagement\Http\Requests\MessageRequest;
use Teamtnt\SalesManagement\Models\Message;
use Teamtnt\SalesManagement\Models\Task;
use Teamtnt\SalesManagement\Mail\TaskEmail;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{

    /**
     * @param  MessageDataTable  $messageDataTable
     * @return mixed
     */
    public function index(Task $task, MessageDataTable $messageDataTable)
    {
        return $messageDataTable
            ->with('taskId', $task->id)
            ->render('sales-management::messages.index', compact('task'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Task $task)
    {
        return view('sales-management::messages.create', compact('task'));
    }

    /**
     * @param  MessageRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Task $task, MessageRequest $messageRequest)
    {
        $request = $messageRequest->all();
        $request['from_name'] = config('sales-management.emails')[$request['from_email']] ?? null;
        Message::create($request);

        request()->session()->flash('message', __('Message successfully created!'));

        return redirect()->route('messages.index', $task);
    }

    /**
     * @param  Message  $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Task $task, Message $message)
    {
        return view('sales-management::messages.edit', compact('message', 'task'));
    }

    /**
     * @param  MessageRequest  $request
     * @param  Message  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Task $task, MessageRequest $messageRequest, Message $message)
    {
        $request = $messageRequest->all();
        $request['from_name'] = config('sales-management.emails')[$request['from_email']] ?? null;

        $message->update($request);

        if ($messageRequest->has('message_stages')) {
            $messageStages = $messageRequest->get('message_stages');

            $messageStagesExistingIds = $message->messageStages->pluck('id')->toArray();
            $messageStagesNewIds = array_column($messageStages, 'id');

            $messageStagesIdsToDelete = array_diff($messageStagesExistingIds, $messageStagesNewIds);

            if (!empty($messageStagesIdsToDelete)) {
                $message->messageStages()->whereIn('id', $messageStagesIdsToDelete)->delete();
            }

            foreach ($messageStages as $messageStage) {
                $message->messageStages()->updateOrCreate(
                    ['id' => $messageStage['id']],
                    [
                        'name'        => $messageStage['name'],
                        'description' => $messageStage['description'],
                        'color'       => $messageStage['color'],
                    ]
                );
            }
        }

        request()->session()->flash('message', __('Message successfully updated!'));

        return redirect()->route('messages.index', $task);
    }

    /**
     * @param  Message  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task, Message $message)
    {
        $message->delete();

        request()->session()->flash('message', __('Message successfully deleted!'));

        return redirect()->route('messages.index', $task);
    }

    public function sendToAllLeads(Task $task, Message $message)
    {
        $leads = $task->leads()->with('contact')->get();

        foreach ($leads as $lead) {
            if ($email = $lead->contact->email) {
                Mail::to($email)->send(new TaskEmail($message, $lead));
            }
        }
        request()->session()->flash('message', __('Message has been sent to all leads!'));

        return redirect()->route('messages.index', $task);
    }
}
