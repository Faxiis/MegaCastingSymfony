<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\ActivityDomain;
use App\Entity\Civility;
use App\Entity\Client;
use App\Entity\ContractType;
use App\Entity\Offers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $datedujour = new \DateTime();

        $civilite = new Civility();
        $civilite->setShortLabel('M.');
        $civilite->setLongLabel('Monsieur');
        $manager->persist($civilite);

        $civilite = new Civility();
        $civilite->setShortLabel('Mme');
        $civilite->setLongLabel('Madame');
        $manager->persist($civilite);


        $contract = new ContractType();
        $contract->setLabel("Contrat à durée indéterminé");
        $contract->setShortLabel("CDI");
        $manager->persist($contract);

        $contract = new ContractType();
        $contract->setLabel("Contrat à durée déterminé");
        $contract->setShortLabel("CDD");
        $manager->persist($contract);

        $contract = new ContractType();
        $contract->setLabel("Interim");
        $contract->setShortLabel("Int");
        $manager->persist($contract);


        $activityDomain = new ActivityDomain();
        $activityDomain->setName('Musique');
        $activityDomain->setDescription('Les métiers de la musique');
        $manager->persist($activityDomain);

        $activity = new Activity();
        $activity->setName('Batteur');
        $activity->setActivityDomains($activityDomain);
        $manager->persist($activity);

        $activity = new Activity();
        $activity->setName('Flutiste');
        $activity->setActivityDomains($activityDomain);
        $manager->persist($activity);

        $activity = new Activity();
        $activity->setName('Guitariste');
        $activity->setActivityDomains($activityDomain);
        $manager->persist($activity);

        $activityDomain = new ActivityDomain();
        $activityDomain->setName('Cinema');
        $activityDomain->setDescription('Les métiers du cinéma');
        $manager->persist($activityDomain);

        $activity = new Activity();
        $activity->setName('Acteur');
        $activity->setActivityDomains($activityDomain);
        $manager->persist($activity);

        $activity = new Activity();
        $activity->setName('Réalisateur');
        $activity->setActivityDomains($activityDomain);
        $manager->persist($activity);

        $client = new Client();
        $client->setFirstName("Jean");
        $client->setLastName("Dupont");
        $client->setAddress("5 rue des cerisier");
        $client->setCity("Le Mans");
        $client->setAddressZipCode("72400");
        $client->setEmail("test@est.met");
        $client->setPhone("06 05 04 05 60");
        $manager->persist($client);

        $of = new Offers();
        $of->setLabel("Offre Fast and Furious");
        $of->setReference("Douze");
        $of->setDescription("Le casting d'asterix");
        $of->setParutionDateTime($datedujour);
        $of->setOfferStartDate($datedujour);
        $of->setOfferEndDate($datedujour);
        $of->setLocalisation("Le Mans");
        $of->setReference("Douze");
        $of->setContractTypes($contract);
        $of->setClients($client);
        $manager->persist($of);

        $of = new Offers();
        $of->setLabel("Offre orchestre laval");
        $of->setReference("Douze");
        $of->setDescription("Le casting de l'orchestre laval");
        $of->setParutionDateTime($datedujour);
        $of->setOfferStartDate($datedujour);
        $of->setOfferEndDate($datedujour);
        $of->setLocalisation("Laval");
        $of->setReference("Rouge");
        $of->setContractTypes($contract);
        $of->setClients($client);
        $manager->persist($of);

        $client = new Client();
        $client->setFirstName("Cyril");
        $client->setLastName("Jeamboins");
        $client->setAddress("5 rue des cheminots");
        $client->setCity("Mulsanne");
        $client->setAddressZipCode("72450");
        $client->setEmail("dada@est.met");
        $client->setPhone("06 10 10 10 60");
        $manager->persist($client);

        $of = new Offers();
        $of->setLabel("Offre asterix");
        $of->setReference("Douze");
        $of->setDescription("Le casting d'asterix");
        $of->setParutionDateTime($datedujour);
        $of->setOfferStartDate($datedujour);
        $of->setOfferEndDate($datedujour);
        $of->setLocalisation("Le Mans");
        $of->setReference("Douze");
        $of->setContractTypes($contract);
        $of->setClients($client);
        $manager->persist($of);

        $off = new Offers();
        $off->setLabel("Offre DisneyLand");
        $off->setReference("Treize");
        $off->setDescription("Le casting de Dingo");
        $off->setParutionDateTime($datedujour);
        $off->setOfferStartDate($datedujour);
        $off->setOfferEndDate($datedujour);
        $off->setLocalisation("Paris");
        $off->setReference("Quarante");
        $off->setContractTypes($contract);
        $off->setClients($client);
        $manager->persist($off);

        $manager->flush();

    }
}
