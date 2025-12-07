<?php

class OrganizerController extends Controller
{
    public function index()
    {
        $this->view('organizer/events/index', [
            'title' => 'Organizer Events'
        ]);
    }
}
