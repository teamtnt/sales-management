<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Workflow\Workflow as SymfonyWorkflow;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;

class Workflow extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'name',
        'description',
        'elements',
        'status',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('sales-management.tablePrefix').'workflows';
        parent::__construct($attributes);
    }

    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }

    public function getStateMachineDefinition()
    {
        $definitionArray = Yaml::parse($this->state_machine_definition);
        $workflowName = array_keys($definitionArray)[0];

        $builder = new DefinitionBuilder;

        foreach ($definitionArray[$workflowName]['places'] as $placeName => $placeValue) {
            $builder->addPlace($placeName);
        }

        foreach ($definitionArray[$workflowName]['transitions'] as $transtionName => $transitionValue) {
            $transition = new Transition($transtionName, $transitionValue['from'], $transitionValue['to']);

            $builder->addTransition($transition);
        }

        return $builder->build();
    }

    public function fsm()
    {
        $definition = $this->getStateMachineDefinition();
        $markingStore = new MethodMarkingStore(true, "currentPlace");

        return new SymfonyWorkflow($definition, $markingStore, null, $this->name);
    }
}
