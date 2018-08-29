<?php

namespace egimaben\sql_seeder;
require_once('./../vendor/autoload.php');
class SkeletonClass
{
    private $faker = null;
    /**
     * Create a new Skeleton Instance
     */
    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
        // constructor body
    }

    /**
     * Friendly welcome
     *
     * @param string $phrase Phrase to return
     *
     * @return string Returns the phrase passed in
     */
    public function echoPhrase($phrase)
    {
        $name = $this->faker->name();
        return $name." ".$phrase;
    }
}
$skel = new SkeletonClass;
echo $skel->echoPhrase('I am a skeleton');
