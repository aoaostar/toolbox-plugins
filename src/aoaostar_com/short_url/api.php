<?php


namespace plugin\aoaostar_com\short_url;


interface api
{
    public function main($url): string;
}