<?php

namespace App\HelperFunctions;

function isTmdbMovieDataOk($data)
{
	return (
		$data
		&& isset($data['overview'])
		&& isset($data['id'])
	);
}
