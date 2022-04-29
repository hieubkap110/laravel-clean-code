<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CleanOneController extends Controller
{
    /**
     * Lookup tables
     * 
     * Instead of writing repetitive else if statements, use an array to look up the wanted value based on the key you have.
     * The code will be cleaner & more readable and you will see understandable exceptions if something goes wrong. No half-passing
     * edge cases.
     */
    public function lookupTables()
    {
        $order = ['type' => 'pdf'];

        //Bad
        // if ($order['type'] === 'pdf') {
        //     $type = 'book';
        // } else if ($order['type'] === 'epub') {
        //     $type = 'book';
        // } else if ($order['type'] === 'license') {
        //     $type = 'license';
        // } else if ($order['type'] === 'artwork') {
        //     $type = 'creative';
        // } else if ($order['type'] === 'song') {
        //     $type = 'creative';
        // } else if ($order['type'] === 'physical') {
        //     $type = 'physical';
        // }

        //Good
        $type = [
            'pdf'      => 'book',
            'epub'     => 'book',
            'license'  => 'license',
            'artwork'  => 'creative',
            'song'     => 'creative',
            'physical' => 'physical',
        ][$order['type']];

        $downloadable = [
            'book'     => true,
            'license'  => true,
            'creative' => true,
            'physical' => false,
        ][$type];

        return $downloadable;
    }

    /**
     * Return early
     * 
     * Try to avoid unnecessary nesting by returning a value early. Too much nesting & else statements tend to make
     * code harder to read.
     */
    public function returnEarly()
    {
        $notificationSent = true;
        $isActive = true;
        $total = 200;
        $canceled = false;
        // Bad
        if ($notificationSent) {
            $notify = false;
        } else if ($isActive) {
            if ($total > 100) {
                $notify = true;
            } else if ($total < 100) {
                $notify = false;
            } else {
                if ($canceled) {
                    $notify = true;
                } else {
                    $notify = false;
                }
            }
        }
        // Good
        if ($notificationSent) {
            return false;
        }
        if ($isActive && $total > 100) {
            return true;
        }
        if (!$isActive && $canceled) {
            return true;
        }
        return false;
    }
}
