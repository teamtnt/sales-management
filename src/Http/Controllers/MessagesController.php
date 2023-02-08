<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\MessageDataTable;
use Teamtnt\SalesManagement\Http\Requests\MessageRequest;
use Teamtnt\SalesManagement\Models\Message;

class MessagesController extends Controller
{

    /**
     * @param MessageDataTable $messageDataTable
     * @return mixed
     */
    public function index(MessageDataTable $messageDataTable)
    {
        return $messageDataTable->render('sales-management::messages.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('sales-management::messages.create');
    }

    /**
     * @param MessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MessageRequest $messageRequest)
    {
        Message::create($messageRequest->validated());

        request()->session()->flash('message', __('Message successfully created!'));

        return redirect()->route('messages.index');
    }

    /**
     * @param Message $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Message $message)
    {
        return view('sales-management::messages.edit', compact('message'));
    }

    /**
     * @param MessageRequest $request
     * @param Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MessageRequest $messageRequest, Message $message)
    {
        $message->update($messageRequest->validated());

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
                        'name' => $messageStage['name'],
                        'description' => $messageStage['description'],
                        'color' => $messageStage['color'],
                    ]
                );
            }

        }

        request()->session()->flash('message', __('Message successfully updated!'));

        return redirect()->route('messages.index');
    }

    /**
     * @param Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Message $message)
    {
        $message->delete();

        request()->session()->flash('message', __('Message successfully deleted!'));

        return redirect()->route('messages.index');
    }
}
