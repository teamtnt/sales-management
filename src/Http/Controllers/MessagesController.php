<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\DataTables\MessageDataTable;
use Teamtnt\SalesManagement\Http\Requests\MessageRequest;
use Teamtnt\SalesManagement\Models\Message;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Mail\CampaignEmail;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{

    /**
     * @param  MessageDataTable  $messageDataTable
     * @return mixed
     */
    public function index(Campaign $campaign, MessageDataTable $messageDataTable)
    {
        return $messageDataTable
            ->with('campaignId', $campaign->id)
            ->render('sales-management::messages.index', compact('campaign'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Campaign $campaign)
    {
        return view('sales-management::messages.create', compact('campaign'));
    }

    /**
     * @param  MessageRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Campaign $campaign, MessageRequest $messageRequest)
    {
        $request = $messageRequest->all();
        $request['from_name'] = config('sales-management.emails')[$request['from_email']] ?? null;
        Message::create($request);

        request()->session()->flash('message', __('Message successfully created!'));

        return redirect()->route('messages.index', $campaign);
    }

    /**
     * @param  Message  $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Campaign $campaign, Message $message)
    {
        return view('sales-management::messages.edit', compact('message', 'campaign'));
    }

    /**
     * @param  MessageRequest  $request
     * @param  Message  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Campaign $campaign, MessageRequest $messageRequest, Message $message)
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
                        'name' => $messageStage['name'],
                        'description' => $messageStage['description'],
                        'color' => $messageStage['color'],
                    ]
                );
            }
        }

        request()->session()->flash('message', __('Message successfully updated!'));

        return redirect()->route('messages.index', $campaign);
    }

    /**
     * @param  Message  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Campaign $campaign, Message $message)
    {
        $message->delete();

        request()->session()->flash('message', __('Message successfully deleted!'));

        return redirect()->route('messages.index', $campaign);
    }

    public function sendToAllLeads(Campaign $campaign, Message $message)
    {
        $leads = $campaign->leads()->with('contact')->get();

        foreach ($leads as $lead) {
            if ($email = $lead->contact->email) {
                Mail::to($email)->send(new CampaignEmail($message, $lead));
            }
        }
        request()->session()->flash('message', __('Message has been sent to all leads!'));

        return redirect()->route('messages.index', $campaign);
    }
}
