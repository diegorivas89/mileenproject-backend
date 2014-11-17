<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	'covered_size' 				 => 'La superficie cubierta es mayor a la superficie total',
	'video_url' 				   => 'Solo se permiten videos de Youtube',
	'invalid_credit_card'  => 'Tarjeta de crédito invalida.',
	"accepted"             => "The :attribute must be accepted.",
	"active_url"           => "El campo :attribute debe ser una url válida.",
	"after"                => "The :attribute must be a date after :date.",
	"alpha"                => "The :attribute may only contain letters.",
	"alpha_dash"           => "The :attribute may only contain letters, numbers, and dashes.",
	"alpha_num"            => "The :attribute may only contain letters and numbers.",
	"array"                => "The :attribute must be an array.",
	"before"               => "The :attribute must be a date before :date.",
	"between"              => array(
		"numeric" => "The :attribute must be between :min and :max.",
		"file"    => "The :attribute must be between :min and :max kilobytes.",
		"string"  => "The :attribute must be between :min and :max characters.",
		"array"   => "The :attribute must have between :min and :max items.",
	),
	"boolean"              => "The :attribute field must be true or false",
	"confirmed"            => "La :attribute no coincide.",
	"date"                 => "The :attribute is not a valid date.",
	"date_format"          => "The :attribute does not match the format :format.",
	"different"            => "The :attribute and :other must be different.",
	"digits"               => "The :attribute must be :digits digits.",
	"digits_between"       => "The :attribute must be between :min and :max digits.",
	"email"                => "El :attribute debe ser una cuenta de email valida",
	"exists"               => "The selected :attribute is invalid.",
	"image"                => "The :attribute must be an image.",
	"in"                   => "The selected :attribute is invalid.",
	"integer"              => "The :attribute must be an integer.",
	"ip"                   => "The :attribute must be a valid IP address.",
	"max"                  => array(
		"numeric" => "El campo :attribute no debe ser mayor a :max.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "El campo :attribute no debe ser mas largo que :max caracteres.",
		"array"   => "The :attribute may not have more than :max items.",
	),
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => array(
		"numeric" => "El campo :attribute debe ser mayor a :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "El campo :attribute debe tener como mínimo :min caracteres.",
		"array"   => "The :attribute must have at least :min items.",
	),

	"not_in"               => "El campo :attribute seleccionado es inválido.",
	"numeric"              => "El campo :attribute debe ser numerico.",
	"regex"                => "El formato del campo :attribute es inválido.",
	"required"             => "El campo :attribute es requerido.",
	"required_if"          => "The :attribute field is required when :other is :value.",
	"required_with"        => "The :attribute field is required when :values is present.",
	"required_with_all"    => "The :attribute field is required when :values is present.",
	"required_without"     => "The :attribute field is required when :values is not present.",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => "The :attribute and :other must match.",
	"size"                 => array(
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	),
	"unique"               => "El :attribute está actualmente en uso.",
	"url"                  => "The :attribute format is invalid.",
	"timezone"             => "The :attribute must be a valid zone.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
		'address' => 'dirección',
	    'title' => 'título',
	    'description' => 'descripción',
	    'age' => 'años',
	    'price' => 'precio',
	    'expenses' => 'expensas',
	    'size' => 'superficie total',
	    'covered_size' => 'superficie cubierta',
	    'password' => 'contraseña',
	    'telephone' => 'teléfono',
	    'credit_card_number' => 'número de tarjeta')

);
