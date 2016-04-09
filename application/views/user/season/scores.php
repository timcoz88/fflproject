<?php //print_r($weeks); ?>
<?php $this->load->view('template/modals/stat_popup'); ?>
<style>

.week-selected{

    background: #DDD;
}
.week-link{
    background: #FAFAFA;
}

.week-link a{
    display:block;
    text-decoration:none;
}

.week-future{
    color: #DDD;
}

</style>

<div class="container">
    <br>
    <div class="row">
        <div class="center-block" style="max-width:600px;">
            <h4 class='text-center'>Week <?=$selected_week?> Scores</h4>
            <table class="table table-responsive table-condensed text-center" style="table-layout:fixed">
                <tr>
                <?php foreach($weeks as $num => $w): ?>
                    <?php if($selected_week == $w->week):?>
                        <td class="week-selected">
                            <?=$w->week?>
                        </td>
                    <?php elseif($w->week <= $this->session->userdata('current_week') && $selected_year >= $this->session->userdata['current_year']):?>
                        <td class="week-link">
                            <a href="<?=site_url('season/scores/week/'.$w->week)?>"><?=$w->week?></a>
                        </td>
                    <?php else:?>
                        <td class="week-future">
                            <?=$w->week?>
                        </td>
                    <?php endif;?>
                <?php endforeach;?>
                </tr>
                <tr><td colspan=<?=count($weeks)?>></td></tr>
            </table>
        </div>

    </div>
    <div class="row">
        <?php foreach($matchups as $m): ?>
            <div class="col-sm-6">
                <table class="table table-condensed table-striped table-border">
                    <thead style="font-size:1.1em" >
                        <th height="55px"><?=$m['home_team']['points']?></th>
                        <th class="text-right" style="width:40%"><?=$m['home_team']['team']->team_name?></th>
                        <th class="text-center"></th>
                        <th style="width:40%"><?=$m['away_team']['team']->team_name?></th>
                        <th class="text-right"><?=$m['away_team']['points']?></th>
                    </thead>
                    <tbody>
                        <?php foreach($m['home_team']['starters'] as $key=>$p): ?>
                            <?php $hp = $m['home_team']['starters'][$key]; ?>
                            <?php $ap = $ap = isset($m['away_team']['starters'][$key]) ? $m['away_team']['starters'][$key] : false; ?>
                            <tr>
                                <?php if ($hp['player']): ?>
                                    <td><?=$hp['player']->points?></td>
                                    <td class="text-right">
                                        <a href="#" class="stat-popup" data-type="player" data-id="<?=$hp['player']->player_id?>"><?=$hp['player']->short_name?></a>
                                    </td>
                                <?php else: ?>
                                    <td></td><td></td>
                                <?php endif;?>

                                <td class="text-center"><strong><?=$hp['pos_text']?></strong></td>

                                <?php if($ap['player']): ?>
                                <td>
                                    <a href="#" class="stat-popup" data-type="player" data-id="<?=$ap['player']->player_id?>"><?=$ap['player']->short_name?></a>
                                </td>
                                <td class="text-right"><?=$ap['player']->points?></td>
                                <?php else: ?>
                                    <td></td><td></td>
                                <?php endif; ?>

                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <hr>
            </div>
        <?php endforeach;?>


    </div>
</div>