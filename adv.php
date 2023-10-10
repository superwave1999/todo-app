<?php

class Lift {
    private int $occupancy;
    public function __construct(
        private readonly int $liftSize,
        int $occupancy,
        private readonly int $floor
    ) {
        $this->occupancy = (int) min($this->liftSize, $occupancy);
    }

    public function getEmptySpaces(): int
    {
        return $this->liftSize - $this->occupancy;
    }

    public function getFloor(): int {
        return $this->floor;
    }
}

// Setup section
$maxFloors = 30;
$numLifts = 6;
$maxLiftSize = 10;
$currentFloor = rand(0, $maxFloors);
$lifts = [];

// Nice messages
echo('Lift Simulator 2023' . PHP_EOL);
echo(" === The building has $maxFloors numbered floors (+ ground floor)" . PHP_EOL);
echo(" === There are $numLifts lifts in the building" . PHP_EOL);

foreach (range(1, rand(1, $numLifts)) as $numLift) {
    $liftSize = rand(4, $maxLiftSize);
    $occupancy = rand(0, $maxLiftSize);
    $liftFloor = rand(0, $maxFloors);
    $lifts[$numLift] = new Lift($liftSize, $occupancy, $liftFloor);
    echo(" --- Lift $numLift - Size: $liftSize, Occupancy: $occupancy, Floor: $liftFloor --- " . PHP_EOL);
}

echo(" === You are waiting on floor $currentFloor" . PHP_EOL);
echo(" === We will find the closest available lift with spaces available" . PHP_EOL);
sleep(1);
echo(" ... Running in 2 seconds ..." . PHP_EOL);
sleep(2);

// Algorithm and output
/** @var Lift[] $freeLifts */
$freeLifts = array_filter($lifts, fn(Lift $lift) => $lift->getEmptySpaces() > 0); //Exclude full lifts
if (!$freeLifts) {
    echo(" --> NO FREE LIFTS AVAILABLE! <-- ");
    exit(1);
}
$freeLiftDistance = array_map(function (Lift $lift) use ($currentFloor) { //Get floor distance to each lift
    return abs($lift->getFloor() - $currentFloor);
}, $freeLifts);
asort($freeLiftDistance); //Sort by ascending distance
$liftNum = array_key_first($freeLiftDistance);
$selectedLiftDistance = $freeLiftDistance[$liftNum];

echo(" --> LIFT Nº$liftNum IS AVAILABLE ($selectedLiftDistance floors difference) <-- ");
