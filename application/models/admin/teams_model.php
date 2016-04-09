<?php

class Teams_model extends MY_Model
{
    function get_league_teams_data($active_only = True)
    {
        $data = $this->db->select('team.id, team.owner_id, team.team_name, team.league_id, team.active') #team
                ->select('owner.first_name, owner.last_name') #owner
                ->from('team')
                ->join('owner', 'owner.id = team.owner_id')
                ->where('team.league_id', $this->leagueid);
                if ($active_only)
                    $this->db->where('team.active',1);
                $data = $this->db->order_by('active','desc')
                ->order_by('team_name','asc')->get();
        return $data->result();

    }

    function get_team_data($teamid)
    {
        $data = $this->db->select('team.id, team.team_name')
                ->select('owner.first_name, owner.last_name, owner.phone_number')
                ->from('team')
                ->join('owner', 'owner.id = team.owner_id')
                ->where('team.league_id', $this->leagueid)
                ->where('team.id', $teamid)
                ->get();
        return $data->result();
    }


    function get_team_name($teamid)
    {
        $data = $this->db->select('team_name')
                ->from('team')
                ->where('team.id', $teamid)
                ->get();
        return $data->row()->team_name;
    }

    function get_league_name()
    {
        $data = $this->db->select('league_name')
                ->from('league')
                ->where('league.id', $this->leagueid)
                ->get();
        return $data->row()->league_name;
    }

    function set_active_flag($teamid, $active)
    {
        $data = array('active' => $active);
        $this->db->where('id',$teamid);
        $this->db->update('team',$data);
    }
}