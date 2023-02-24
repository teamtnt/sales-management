<?php

namespace Teamtnt\SalesManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Workflow\Workflow as SymfonyWorkflow;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;
use Symfony\Component\Workflow\Metadata\InMemoryMetadataStore;

class Workflow extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

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
        $transitionsMetadata = new \SplObjectStorage();
        $placesMetadata = [];

        foreach ($definitionArray[$workflowName]['places'] as $placeName => $placeValue) {
            $builder->addPlace($placeName);

            if (isset($placeValue['metadata'])) {
                $placesMetadata[$placeName] = $placeValue['metadata'];
            }
        }

        foreach ($definitionArray[$workflowName]['transitions'] as $transitionName => $transitionValue) {
            $transition = new Transition($transitionName, $transitionValue['from'], $transitionValue['to']);

            $builder->addTransition($transition);

            if (isset($transitionValue['metadata'])) {
                $transitionsMetadata[$transition] = $transitionValue['metadata'];
            }
        }

        $metaDataStore = new InMemoryMetadataStore([], $placesMetadata, $transitionsMetadata);
        $builder->setMetadataStore($metaDataStore);

        return $builder->build();
    }

    public function fsm()
    {
        $definition = $this->getStateMachineDefinition();
        $markingStore = new MethodMarkingStore(true, "currentPlace");

        return new SymfonyWorkflow($definition, $markingStore, null, $this->name);
    }

    public function isPublished()
    {
        return self::STATUS_PUBLISHED == $this->status;
    }

}
