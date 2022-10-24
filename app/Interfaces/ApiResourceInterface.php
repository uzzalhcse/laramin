<?php

namespace App\Interfaces;

interface ApiResourceInterface
{
    public function formatResponse($is_detail = false): array;

}
