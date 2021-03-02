<div class="" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li class="active"><a href="#tab_basic_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> <?php echo $this->lang->line('basic informations'); ?></a> </li>  
        <li  class=""><a href="#tab_activity"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-clipboard"></i> <?php echo $this->lang->line('activity'); ?> </a> </li>                          
    </ul>
    <br/>

    <div class="tab-content">
        <div  class="tab-pane fade in active" id="tab_basic_info" >               
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width="20%"><?php echo $this->lang->line('code'); ?></th>
                        <td  width="30%"><?php echo $child->code; ?></td>
                        <th  width="20%"><?php echo $this->lang->line('name'); ?></th>
                        <td  width="30%"><?php echo $child->nom.' '.$child->prenom; ?></td>
                    </tr>
                    <tr> 
                        <th><?php echo $this->lang->line('birth_date'); ?></th>
                        <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($child->datenaissance)); ?></td>
                        <th><?php echo $this->lang->line('gender'); ?></th>
                        <td><?php echo $this->lang->line($child->sexe); ?></td>
                    
                    </tr>
                    
                    <tr>
                         <th><?php echo $this->lang->line('email'); ?></th>
                        <td><?php echo $child->email; ?></td>
                                          
                        <th><?php echo $this->lang->line('children'); ?> <?php echo $this->lang->line('photo'); ?></th>
                        <td>
                            <?php if ($child->photo) { ?>
                                <img src="<?php echo UPLOAD_PATH; ?>/child-photo/<?php echo $child->photo; ?>" alt="" width="70" />
                            <?php } ?>
                        </td>
                        
                    </tr>
                    
                    
                </tbody>
            </table>                
        </div>
        
        
        <div  class="tab-pane fade in " id="tab_activity" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th><?php echo $this->lang->line('sl_no'); ?></th>
                    <th><?php echo $this->lang->line('activity'); ?> </th>
                    <th><?php echo $this->lang->line('activity'); ?> <?php echo $this->lang->line('date'); ?></th>
                    <th><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                 <tbody>   
                    <?php $count = 1; if(isset($activity) && !empty($activity)){ ?>
                    <?php foreach($activity as $obj){ ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $obj->activity; ?></td>
                        <td><?php echo date('M j,Y', strtotime($obj->activity_date)); ?></td>  
                        <td>
                            <?php if(has_permission(EDIT, 'child', 'activity')){ ?>
                            <a target="_blank" href="<?php echo site_url('child/activity/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                            <?php } ?>
                            <?php if(has_permission(VIEW, 'child', 'activity')){ ?>
                                <a  onclick="get_activity_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-activity-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                            <?php } ?>
                            <?php if(has_permission(DELETE, 'child', 'activity')){ ?>
                                <a href="<?php echo site_url('child/activity/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>                   
            </table>  
        </div>  
        
    </div>
</div>

<style type="text/css">
    .table>thead>tr>th { padding: 1px 4px;}
    .table>tbody>tr>th { padding: 1px 4px;}    
    .table>tbody>tr>td { padding: 1px 4px;}    
</style>


