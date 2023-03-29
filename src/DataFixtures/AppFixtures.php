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
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr, FR');

        $datedujour = new \DateTime();

        $civilitef = new Civility();
        $civilitef->setShortLabel('M.');
        $civilitef->setLongLabel('Monsieur');
        $manager->persist($civilitef);

        $civilitem = new Civility();
        $civilitem->setShortLabel('Mme');
        $civilitem->setLongLabel('Madame');
        $manager->persist($civilitem);


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

        $activityb = new Activity();
        $activityb->setName('Batteur');
        $activityb->setActivityDomains($activityDomain);
        $manager->persist($activityb);

        $activityf = new Activity();
        $activityf->setName('Flutiste');
        $activityf->setActivityDomains($activityDomain);
        $manager->persist($activityf);

        $activityg = new Activity();
        $activityg->setName('Guitariste');
        $activityg->setActivityDomains($activityDomain);
        $manager->persist($activityg);

        $activityDomain = new ActivityDomain();
        $activityDomain->setName('Cinema');
        $activityDomain->setDescription('Les métiers du cinéma');
        $manager->persist($activityDomain);

        $activitya = new Activity();
        $activitya->setName('Acteur');
        $activitya->setActivityDomains($activityDomain);
        $manager->persist($activitya);

        $activityr = new Activity();
        $activityr->setName('Réalisateur');
        $activityr->setActivityDomains($activityDomain);
        $manager->persist($activityr);

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
        $of->addCivility($civilitef);
        $of->addCivility($civilitem);
        $of->addActivity($activitya);
        $of->addActivity($activityb);
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
        $of->addCivility($civilitem);
        $of->addActivity($activityf);
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
        $of->addCivility($civilitef);
        $of->addCivility($civilitem);
        $of->addActivity($activityf);
        $of->addActivity($activitya);
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
        $off->addCivility($civilitem);
        $off->addActivity($activitya);
        $manager->persist($off);

        $off = new Offers();
        $off->setLabel("Fast and Furious");
        $off->setReference("Sept");
        $off->setDescription("Des bagnoles, des filles tout est bon dans le cochon");
        $off->setParutionDateTime($datedujour);
        $off->setOfferStartDate($datedujour);
        $off->setOfferEndDate($datedujour);
        $off->setLocalisation("7 Weshington Street");
        $off->setReference("Quarante quatre");
        $off->setContractTypes($contract);
        $off->setClients($client);
        $off->addCivility($civilitem);
        $off->addActivity($activityf);
        $off->addActivity($activityg);
        $manager->persist($off);

        $off = new Offers();
        $off->setLabel("Harry Potter");
        $off->setReference("Huit");
        $off->setDescription("Le rôle de Drago Malfoy est vacant");
        $off->setParutionDateTime($datedujour);
        $off->setOfferStartDate($datedujour);
        $off->setOfferEndDate($datedujour);
        $off->setLocalisation("Los Angeles");
        $off->setReference("Soixante");
        $off->setContractTypes($contract);
        $off->setClients($client);
        $off->addCivility($civilitef);
        $off->addActivity($activitya);
        $manager->persist($off);

        $off = new Offers();
        $off->setLabel("Blue Lock");
        $off->setReference("Onze");
        $off->setDescription("Qui sera le prochain Isagi qui sauvera la nation du Japon dans le football");
        $off->setParutionDateTime($datedujour);
        $off->setOfferStartDate($datedujour);
        $off->setOfferEndDate($datedujour);
        $off->setLocalisation("Japon");
        $off->setReference("Trente");
        $off->setContractTypes($contract);
        $off->setClients($client);
        $off->addCivility($civilitef);
        $off->addActivity($activityb);
        $manager->persist($off);

        $off = new Offers();
        $off->setLabel("Star Wars");
        $off->setReference("Chewbacca");
        $off->setDescription("Nous cherchons un Chewbacca");
        $off->setParutionDateTime($datedujour);
        $off->setOfferStartDate($datedujour);
        $off->setOfferEndDate($datedujour);
        $off->setLocalisation("Las Vegas");
        $off->setReference("Quarante-cinq");
        $off->setContractTypes($contract);
        $off->setClients($client);
        $off->addCivility($civilitef);
        $off->addCivility($civilitem);
        $off->addActivity($activityg);
        $manager->persist($off);

        for ($i = 1; $i<=500 ; $i++) {
            $offre = new Offers();
            $offre->setLabel($faker->name());
            $offre->setDescription($faker->paragraphs(2, true));
            $offre->setReference($faker->name());
            $offre->setParutionDateTime($faker->dateTime());
            $offre->setOfferStartDate($faker->dateTime());
            $offre->setOfferEndDate($faker->dateTime());
            $offre->setLocalisation($faker->name());
            $offre->setContractTypes($contract);
            $offre->setClients($client);
            $offre->addCivility($civilitem);
            $offre->addActivity($activityg);

            $manager->persist($offre);
        }

        $manager->flush();

    }
}
