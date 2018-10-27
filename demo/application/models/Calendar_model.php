<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_model extends CI_Model {


/*Read the data from DB */
    Public function getEvents()
    {
    $building_id = $this->session->userdata('building_sess_id');

    $sql = "SELECT * FROM events WHERE ((events.start BETWEEN ? AND ? ) AND (building_id=$building_id)) ORDER BY events.start ASC";
    return $this->db->query($sql, array($_GET['start'], $_GET['end']))->result();

    }

/*Create new events */

    Public function addEvent()
    {
    $building_id = $this->session->userdata('building_sess_id');

    $sql = "INSERT INTO events (title,events.start,events.end,description, color, building_id) VALUES (?,?,?,?,?,?)";
    $this->db->query($sql, array($_POST['title'], $_POST['start'],$_POST['end'], $_POST['description'], $_POST['color'], $building_id));
        return ($this->db->affected_rows()!=1)?false:true;
    }

    /*Update  event */

    Public function updateEvent()
    {
    $building_id = $this->session->userdata('building_sess_id');

    $sql = "UPDATE events SET title = ?, description = ?, color = ? WHERE (id = ? AND building_id = $building_id)";
    $this->db->query($sql, array($_POST['title'],$_POST['description'], $_POST['color'], $_POST['id']));
        return ($this->db->affected_rows()!=1)?false:true;
    }


    /*Delete event */

    Public function deleteEvent()
    {
    $building_id = $this->session->userdata('building_sess_id');
    $sql = "DELETE FROM events WHERE (id = ? AND building_id = $building_id)";
    $this->db->query($sql, array($_GET['id']));
        return ($this->db->affected_rows()!=1)?false:true;
    }

    /*Update  event */

    Public function dragUpdateEvent()
    {
            //$date=date('Y-m-d h:i:s',strtotime($_POST['date']));
$building_id = $this->session->userdata('building_sess_id');
            $sql = "UPDATE events SET  events.start = ? ,events.end = ?  WHERE (id = ? AND building_id = $building_id)";
            $this->db->query($sql, array($_POST['start'],$_POST['end'], $_POST['id']));
        return ($this->db->affected_rows()!=1)?false:true;


    }






}