<?php
/**
 * Pet Response Data
 *
 * @package Petfinder
 * @subpackage Responses
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Responses;

class Pet
{
    /**
     * @var array
     */
    public $options = [];

    /**
     * @var string
     */
    public $status = '';

    /**
     * @var Contact
     */
    public $contact;

    /**
     * @var string
     */
    public $age;

    /**
     * @var string
     */
    public $size;

    /**
     * @var \stdClass
     */
    public $media;

    /**
     * @var integer
     */
    public $id;

    /**
     * @var \stdClass
     */
    public $shelterPetId;

    /**
     * @var string[]
     */
    public $breeds = [];

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $sex;

    /**
     * @var string
     */
    public $description;

    /**
     * @var boolean
     */
    public $mix = false;

    /**
     * @var string
     */
    public $shelterId;

    /**
     * @var \DateTime
     */
    public $lastUpdate;

    /**
     * @var string
     */
    public $animal;

    /**
     * Pet constructor.
     * @param $rawPetData
     */
    public function __construct($rawPetData)
    {
        if (!empty($rawPetData->options->option))
        {
            if (is_array($rawPetData->options->option))
            {
                foreach ($rawPetData->options->option as $option)
                {
                    $this->options[] = $option->{'$t'};
                }
            }
            else
            {
                $this->options[] = $rawPetData->options->option->{'$t'};
            }
        }

        $this->status = !empty($rawPetData->status->{'$t'}) ? $rawPetData->status->{'$t'} : '';
        $this->contact = !empty($rawPetData->contact) ? new Contact($rawPetData->contact) : null;
        $this->age = !empty($rawPetData->age->{'$t'}) ? $rawPetData->age->{'$t'} : '';
        $this->size = !empty($rawPetData->size->{'$t'}) ? $rawPetData->size->{'$t'} : '';
        $this->id = !empty($rawPetData->id->{'$t'}) ? $rawPetData->id->{'$t'} : '';
        $this->shelterPetId = !empty($rawPetData->shelterPetId->{'$t'}) ? $rawPetData->shelterPetId->{'$t'} : '';

        if (!empty($rawPetData->breeds))
        {
            foreach ($rawPetData->breeds as $breed)
            {
                if (empty($breed->{'$t'})) continue;

                $this->breeds[] = $breed->{'$t'};
            }
        }

        $this->media = !empty($rawPetData->media) ? new Media($rawPetData->media) : null;

        $this->name = !empty($rawPetData->name->{'$t'}) ? $rawPetData->name->{'$t'} : '';
        $this->sex = !empty($rawPetData->sex->{'$t'}) ? $rawPetData->sex->{'$t'} : '';
        $this->description = !empty($rawPetData->description->{'$t'}) ? $rawPetData->description->{'$t'} : '';
        $this->mix = (!empty($rawPetData->mix->{'$t'}) && $rawPetData->mix->{'$t'} == 'yes') ? true : false;
        $this->shelterId = !empty($rawPetData->shelterId->{'$t'}) ? $rawPetData->shelterId->{'$t'} : '';
        $this->lastUpdate = !empty($rawPetData->lastUpdate->{'$t'}) ? new \DateTime($rawPetData->lastUpdate->{'$t'}) : '';
        $this->animal = !empty($rawPetData->animal->{'$t'}) ? $rawPetData->animal->{'$t'} : '';
    }
}