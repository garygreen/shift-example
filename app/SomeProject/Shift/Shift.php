<?php namespace SomeProject\Shift;

use Eloquent;

class Shift extends Eloquent
{
	protected $table = 'shift_times';
	public $timestamps = false;

	/**
	 * Date fields
	 * @return array
	 */
	public function getDates()
	{
		return array_merge(parent::getDates(), array(
			'start', 'end'
		));
	}

	/**
	 * Gets the start date (without time)
	 * @return string
	 */
	public function getStartDateAttribute()
	{
		return $this->start->toDateString();
	}

	/**
	 * Gets the start/end time seperated by a dash
	 * @return string
	 */
	public function getStartEndTimeAttribute()
	{
		$startHour        = $this->start->hour;
		$endHour          = $this->end->hour;
		$displayStartHour = $startHour > 12 ? $startHour - 12 . 'pm' : $startHour . 'am';
		$displayEndHour   = $endHour > 12 ? $endHour - 12 . 'pm' : $endHour . 'am';
		return $startHour . '-' . $displayEndHour;
	}
}