<?php

namespace App\HelperFunctions;

function isTmdbMovieDataOk($data)
{
	return (
		$data
		&& !empty($data['overview'])
		&& !empty($data['id'])
	);
}
