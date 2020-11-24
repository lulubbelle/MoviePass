<?php

namespace Interfaces;

use Models\Ticket as Ticket;

interface ITicketRepository{
    function GetAll();
    function GetById($id);
    function AddOne(Ticket $ticket);
    function UpdateQrFileName($ticketId, $qrFileName);
}

?>