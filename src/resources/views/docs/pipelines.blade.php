@extends('sales-management::layouts.app')

@section('title', 'Pipelines Guide')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="mx-auto col-lg-10 col-xl-8">
                <h1 class="h3">Pipelines Guide</h1>
                <p class="text-lg">
                    Pipelines are an essential part of our application, helping users to manage their campaigns and track the progress of contacts through different stages. In this guide, we will explain what pipelines are, how they work in our app, and provide an example to help you understand their purpose.
                </p>
                <hr class="my-4">
                
                <div id="introduction" class="mb-5">
                    <h3>What are Pipelines?</h3>
                    <p class="text-lg">
                        A pipeline is a visual representation of the different stages involved in a campaign. Each stage represents a specific step in the process, and contacts move through these stages as they progress in the campaign. Using pipelines allows you to have a clear overview of the status of your contacts and helps you manage your campaigns more effectively.
                    </p>
                </div>
                
                <div id="pipelines-in-app" class="mb-5">
                    <h3>How Pipelines Work in Our App</h3>
                    <p class="text-lg">
                        In our application, pipelines consist of multiple stages that can be added, edited, or removed based on your needs. When creating a campaign, you will need to select a contact list and a pipeline to associate with the campaign.
                    </p>
                    <p class="text-lg">
                        The campaign page displays the pipeline stages on a Kanban board, allowing you to drag and drop contacts from one stage to another as they progress through the campaign. This visual approach makes it easy to track the progress of your contacts and monitor the overall performance of your campaigns.
                    </p>
                </div>

                <div id="example" class="mb-5">
                    <h3>Example of a Pipeline</h3>
                    <p class="text-lg">
                        Let's say you are running an email campaign to promote a new product. Your pipeline might consist of the following stages:
                    </p>
                    <ol class="text-lg">
                        <li>Initial Contact</li>
                        <li>Sent Product Information</li>
                        <li>Follow-up Email</li>
                        <li>Scheduled Meeting</li>
                        <li>Closed Deal</li>
                    </ol>
                    <p class="text-lg">
                        As contacts move through these stages, you can easily track their progress on the Kanban board and make informed decisions about the next steps in your campaign.
                    </p>
                </div>

            </div>
        </div>
    </div>
</main>
@stop
