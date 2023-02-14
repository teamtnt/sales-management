<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Teamtnt\SalesManagement\Models\Pipeline;
use Teamtnt\SalesManagement\Models\PipelineStage;

return new class extends Migration {
    public function up()
    {
        $pipeline = Pipeline::create([
            'name'        => 'Sales Pipeline',
            'description' => "A sales pipeline is a sequence of steps or stages that a salesperson or sales team follows to turn a potential customer into a buyer. It's a defined process that outlines the specific actions and tasks that need to be taken at each stage of the sales process, from the initial contact with a potential customer to closing the sale.
A well-defined sales workflow helps ensure that the sales team is following a consistent and effective approach to selling. By breaking down the sales process into smaller, manageable steps, it allows salespeople to focus on each stage of the process and identify where potential bottlenecks or issues may arise. This, in turn, can help improve the overall efficiency of the sales process and increase the chances of converting prospects into customers.",
        ]);
        PipelineStage::create([
            'name'        => 'Appointment scheduled',
            'description' => 'Appointment Scheduled: The initial step of the sales process where the sales representative schedules an appointment with a potential customer to discuss the product or service.',
            'pipeline_id' => $pipeline->id,
            'color'       => '#932092',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Qualified',
            'description' => 'Qualified: Once the appointment is scheduled, the sales representative will qualify the prospect to ensure they have a need for the product or service and can afford it.',
            'pipeline_id' => $pipeline->id,
            'color'       => '#ff9200',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Presentation scheduled',
            'description' => 'Presentation Scheduled: If the prospect is qualified, the sales representative will schedule a presentation to showcase the features and benefits of the product or service.',
            'pipeline_id' => $pipeline->id,
            'color'       => '#aa7941',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Decision maker bought-in',
            'description' => 'Decision Maker Bought-In: After the presentation, the sales representative will work to get the decision maker to agree to move forward with the purchase.',
            'pipeline_id' => $pipeline->id,
            'color'       => '#00fcff',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Contract sent',
            'description' => 'Contract Sent: Once the decision maker is bought-in, the sales representative will send a contract to formalize the purchase agreement.',
            'pipeline_id' => $pipeline->id,
            'color'       => '#ff40ff',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Won',
            'description' => 'Won: If the contract is accepted and signed, the sale is won.',
            'pipeline_id' => $pipeline->id,
            'color'       => '#00f900',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Lost',
            'description' => 'Lost: If the prospect decides not to move forward with the purchase, the sale is lost.',
            'pipeline_id' => $pipeline->id,
            'color'       => '#ff2600',
            'properties'  => null,
        ]);
        $pipeline2 = Pipeline::create([
            'name'        => 'Backlink Checker',
            'description' => "Backlinks are links from other websites that point to a specific site, and they are an important factor in determining a website's search engine ranking.",
        ]);
        PipelineStage::create([
            'name'        => 'Has Backlink',
            'description' => "Has Backlink: This means that the backlink checker has found at least one external website that is linking to the website being analyzed. Having backlinks from other websites can be an indicator of the quality and authority of a website, which can positively impact its search engine ranking.",
            'pipeline_id' => $pipeline2->id,
            'color'       => '#00f900',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'No Backlink',
            'description' => "No Backlink: This means that the backlink checker did not find any external websites that are linking to the website being analyzed. Having no backlinks may indicate that the website has not been actively promoted or that it may not be seen as an authoritative or valuable source of information by other websites.",
            'pipeline_id' => $pipeline2->id,
            'color'       => '#ff2600',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Not Checkable',
            'description' => "Not Checkable: This means that the backlink checker was not able to analyze the backlink profile of the website being analyzed for some reason. This could be due to technical issues with the website or limitations of the backlink checker tool itself. In such cases, it's important to troubleshoot the issue to determine the cause of the problem and try again later.",
            'pipeline_id' => $pipeline2->id,
            'color'       => '#ff9200',
            'properties'  => null,
        ]);
    }

    public function down()
    {
    }
};
