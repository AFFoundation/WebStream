<?php


class Html extends CHtml {

	public static function faIcon(string $name, string $size = 'lg'): string {
		return self::tag('i', array(
			'class' => 'fa fa-' . $name . ' fa-' . $size
		), '');
	}
}