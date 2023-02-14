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
            'description' => 'Sales Pipeline description',
        ]);
        PipelineStage::create([
            'name'        => 'Appointment scheduled',
            'description' => 'Appointment scheduled',
            'pipeline_id' => $pipeline->id,
            'color'       => '#932092',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Qualified',
            'description' => 'Qualified',
            'pipeline_id' => $pipeline->id,
            'color'       => '#ff9200',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Presentation scheduled',
            'description' => 'Presentation scheduled',
            'pipeline_id' => $pipeline->id,
            'color'       => '#aa7941',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Decision maker bought-in',
            'description' => 'Decision maker bought-in',
            'pipeline_id' => $pipeline->id,
            'color'       => '#00fcff',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Contract sent',
            'description' => 'Contract sent',
            'pipeline_id' => $pipeline->id,
            'color'       => '#ff40ff',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Won',
            'description' => 'Won',
            'pipeline_id' => $pipeline->id,
            'color'       => '#00f900',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Lost',
            'description' => 'Lost',
            'pipeline_id' => $pipeline->id,
            'color'       => '#ff2600',
            'properties'  => null,
        ]);
        $pipeline2 = Pipeline::create([
            'name'        => 'Backlink Checker',
            'description' => 'Backlink Checker description',
        ]);
        PipelineStage::create([
            'name'        => 'Has Backlink',
            'description' => 'Has Backlink',
            'pipeline_id' => $pipeline2->id,
            'color'       => '#00f900',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'No Backlink',
            'description' => 'No Backlink',
            'pipeline_id' => $pipeline2->id,
            'color'       => '#ff2600',
            'properties'  => null,
        ]);
        PipelineStage::create([
            'name'        => 'Not Checkable',
            'description' => 'Not Checkable',
            'pipeline_id' => $pipeline2->id,
            'color'       => '#ff9200',
            'properties'  => null,
        ]);
    }

    public function down()
    {
    }
};
