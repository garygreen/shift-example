<?php namespace SomeProject\Shift;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class ShiftRepository
{
	public function __construct(Shift $shift)
	{
		$this->shift = $shift;
	}

	/**
	 * Gets shift table between the given start/end time
	 * @param  Carbon $start 
	 * @param  Carbon $end   
	 * @return Collection   Grouped by shift date and shift start/end times
	 */
	public function getTable(Carbon $start, Carbon $end)
	{
		// Get the shifts for the range to display
		$shifts = $this->shift->whereBetween('start', array($start, $end))
			->orderBy('start')
			->get();

		// Group the shifts by start date
		$shiftDates = $shifts->groupBy('start_date');

		// Loop through the shifts
		foreach ($shiftDates as $dateKey => $shifts)
		{
			$shiftTimes = new Collection($shifts);

			// Group the date by start/end times
			$shiftDates->put($dateKey, $shiftTimes->groupBy('start_end_time'));
		}

		return $shiftDates;
	}
}