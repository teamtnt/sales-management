<?php

namespace Teamtnt\SalesManagement\FSM;

use Symfony\Component\Yaml\Yaml;

class StateMachineBuilder
{
    public array $places = [];
    public array $transitions = [];

    public function buildFromElements($elements, $title)
    {
        if (count($elements) > 0) {
            foreach ($elements as $element) {
                $this->buildPlaces($element);
                $this->buildTransitions($element);
            }
        }

        $return = [
            $title => [
                'type'          => 'state_machine',
                'supports'      => ['Teamtnt\SalesManagement\Models\LeadJourney'],
                'initial_place' => 'start',
                'places'        => $this->places,
                'transitions'   => $this->transitions,
            ]
        ];

        return Yaml::dump($return);
    }

    public function buildPlaces($element)
    {
        if (isset($element['handleBounds']['source'])) {
            foreach ($element['handleBounds']['source'] as $state) {
                $this->places[$state['id']] = null;
            }
        }
    }

    public function buildTransitions($element)
    {
        if (isset($element['sourceHandle']) && isset($element['targetNode'])) {
            foreach ($element['targetNode']['handleBounds']['source'] as $toState) {
                $transition = [];
                $transition['from'] = $element['sourceHandle'];
                $transition['to'] = $toState['id'];
                $transition['metadata'] = $element['targetNode']['data'];
                $this->addToTransitions($transition);
            }
        }
    }

    public function generateTransitionNameFromTransition($transition)
    {
        $parseName = explode('.', $transition['to']);
        if ($parseName[0] === 'state') {
            $parseName[0] = 'transition';
            $transitionName = implode('.', $parseName);
        } else {
            $transitionName = 'transition.'.$transition['to'];
        }

        return $transitionName;
    }

    public function addToTransitions($transition)
    {
        $transitionName = $this->generateTransitionNameFromTransition($transition);
        if (isset($this->transitions[$transitionName])) {
            if (is_array($this->transitions[$transitionName]['from'])) {
                $this->transitions[$transitionName]['from'][] = $transition['from'];
            } else {
                $this->transitions[$transitionName]['from'] = [$this->transitions[$transitionName]['from'], $transition['from']];
            }
        } else {
            $this->transitions[$transitionName] = $transition;
        }
    }

}