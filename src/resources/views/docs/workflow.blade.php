@extends('sales-management::layouts.app')

@section('title', 'Workflow Guide')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="mx-auto col-lg-10 col-xl-8">
                <h1 class="h3">Workflow Guide</h1>
                <p class="text-lg">
                    Workflows are an essential part of managing your campaigns in our application. In this guide, we will explain what workflows are, how they work in our app, and provide an overview of each element to help you understand their purpose and use.
                </p>
                <hr class="my-4">

                <div id="introduction" class="mb-5">
                    <h3>What are Workflows?</h3>
                    <p class="text-lg">
                        A workflow is a visual representation of the sequence of actions and conditions that occur during a campaign. It helps you automate processes, manage tasks, and track the progress of your contacts. Workflows are created by connecting various elements, such as conditions and actions, which define the flow and logic of your campaign.
                    </p>
                </div>

                <div id="workflow-in-app" class="mb-5">
                    <h3>How Workflows Work in Our App</h3>
                    <p class="text-lg">
                        In our application, workflows are created using a drag-and-drop interface. You start with a "Start" element, which is the beginning of the workflow. From there, you can add condition elements and action elements to create your custom flow.
                    </p>
                    <p class="text-lg">
                        Condition elements are used to define the triggers for specific actions, while action elements represent the tasks to be executed when the conditions are met. By connecting these elements, you can create a workflow that automates and manages your campaign effectively.
                    </p>
                </div>

                <div id="elements" class="mb-5">
                    <h3>Workflow Elements</h3>
                    <p class="text-lg">
                        The following elements are available in our app to create your custom workflow:
                    </p>
                    <h4 class="mt-3">Condition Elements</h4>
                    <ul class="text-lg">
                        <li><strong>On Run:</strong> This condition is triggered when "Run" button is clicked</li>
                        <li><strong>Stage Changed:</strong> This condition is triggered when a contact moves to a different stage in the pipeline.</li>
                        <li><strong>Message Opened:</strong> This condition is triggered when a contact opens an email sent as part of the campaign.</li>
                        <li><strong>Link Clicked:</strong> This condition is triggered when a contact clicks a link in an email sent as part of the campaign.</li>
                    </ul>

                    <h4 class="mt-3">Action Elements</h4>
                    <ul class="text-lg">
                        <li><strong>Send Message:</strong> This action sends an email or message to the contact.</li>
                        <li><strong>Wait:</strong> This action pauses the workflow for a specified duration before continuing.</li>
                        <li><strong>Add Tag:</strong> This action adds a specific tag to a contact.</li>
                        <li><strong>Move To List:</strong> This action moves a contact to a different contact list.</li>
                        <li><strong>A/B Split:</strong> This action allows you to test two different paths in your workflow by randomly assigning contacts to either path A or path B. This helps you determine which path performs better.</li>
                        <li><strong>Change Stage:</strong> This action moves a contact to a different stage in the pipeline, allowing you to track their progress through the campaign.</li>
                    </ul>
                </div>

                <div id="example" class="mb-5">
                    <h3>Workflow Example</h3>
                    <p class="text-lg">
                        Let's create a simple workflow for a campaign. We will start with the "Start" element and connect it to the "On Run" condition. This means that the workflow will begin as soon as the "Run" button is clicked.
                    </p>
                    <p class="text-lg">
                        Next, we will add a "Send Message" action to send an email to our contacts when the "On Run" condition is triggered.
                    </p>
                    <p class="text-lg">
                        After that we will add a "Message Opened" condition. This gives a contact 24 hours to open the email, oterwise we consider the message not being opened. If the message was opened, we will move the contact to a new stage in the pipeline using the "Change Stage" action. If the message was not opened, we can add a "Link Clicked" condition to check if the contact clicked any links in the email. If they did, we can move them to a different stage using another "Change Stage" action.
                    </p>
                    <p class="text-lg">
                        By connecting these elements, we have created a simple workflow that automates the process of sending an email, waiting for user interaction, and moving contacts through different stages based on their actions.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@stop
