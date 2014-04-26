<?php

use Carbon\Carbon;
use SomeProject\Shift\ShiftRepository;

class ShiftController extends Controller
{
	public function __construct(ShiftRepository $shiftRepository)
	{
		$this->shifts = $shiftRepository;
	}

	/**
	 * Shows shift times table
	 * @return View
	 */
	public function times()
	{
		// Set the start/end time to display the shifts between
		$now   = Carbon::now();
		$start = $now->copy()->startOfWeek();
		$end   = $start->copy()->endOfWeek();

		// Get the times table
		$shiftDates = $this->shifts->getTable($start, $end);

		return View::make('shifts.times', array('shift_dates' => $shiftDates));
	}
}