<div class="" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li class="active"><a href="#tab_basic_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> <?php echo $this->lang->line('basic'); ?> <?php echo $this->lang->line('information'); ?></a> </li>
        <li class=""><a href="#tab_guardian_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-paw"></i> <?php echo $this->lang->line('guardian'); ?> <?php echo $this->lang->line('information'); ?></a> </li>
        <li class=""><a href="#tab_parent_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-male"></i> <?php echo $this->lang->line('parent'); ?> <?php echo $this->lang->line('information'); ?></a> </li>
    </ul>
    <br/>

    <div class="tab-content">
        <div  class="tab-pane fade in active" id="tab_basic_info" >               
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>                    
                    <tr>                       
                        <th width="20%"><?php echo $this->lang->line('name'); ?></th>
                        <td  width="30%"><?php echo $admission->name; ?></td>
                        <th width="30%"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('type'); ?></th>
                        <td width="20%"><?php echo $admission->type; ?></td>                                             
                    </tr>
                    <tr>                       
                        <th><?php echo $this->lang->line('class'); ?></th>
                        <td><?php echo $admission->class_name; ?></td>                         
                        <th><?php echo $this->lang->line('group'); ?></th>
                        <td><?php echo $admission->group; ?></td>   
                    </tr>                  
                    
                    <tr>
                        <th><?php echo $this->lang->line('gender'); ?></th>
                        <td><?php echo $this->lang->line($admission->gender); ?></td>
                        <th><?php echo $this->lang->line('blood_group'); ?></th>
                        <td><?php echo $this->lang->line($admission->blood_group); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('religion'); ?></th>
                        <td><?php echo $admission->religion; ?></td>
                        <th><?php echo $this->lang->line('caste'); ?></th>
                        <td><?php echo $admission->caste; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('phone'); ?></th>
                        <td><?php echo $admission->phone; ?></td>                        
                         <th><?php echo $this->lang->line('email'); ?></th>
                        <td><?php echo $admission->email; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('national_id'); ?></th>
                        <td><?php echo $admission->national_id; ?></td>                        
                         <th><?php echo $this->lang->line('second'); ?> <?php echo $this->lang->line('language'); ?></th>
                        <td><?php echo $admission->second_language; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?></th>
                        <td><?php echo $admission->present_address; ?></td>
                        <th><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?></th>
                        <td><?php echo $admission->permanent_address; ?></td>                        
                    </tr>                    
                    <tr>
                        <th><?php echo $this->lang->line('previous'); ?> <?php echo $this->lang->line('school'); ?> </th>
                        <td><?php echo $admission->previous_school; ?></td>
                        <th><?php echo $this->lang->line('previous'); ?> <?php echo $this->lang->line('class'); ?> </th>
                        <td><?php echo $admission->previous_class; ?></td>
                    </tr>  
                    <tr> 
                        <th><?php echo $this->lang->line('application'); ?> <?php echo $this->lang->line('date'); ?></th>
                        <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($admission->created_at)); ?></td>
                        <th><?php echo $this->lang->line('birth_date'); ?></th>
                        <td><?php echo date($this->gsms_setting->sms_date_format, strtotime($admission->dob)); ?></td>
                    </tr>                   
                    <tr> 
                        <th><?php echo $this->lang->line('health_condition'); ?></th>
                        <td><?php echo $admission->health_condition; ?></td>                                              
                        <th><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('photo'); ?></th>
                        <td>
                            <?php if ($admission->photo) { ?>
                                <img src="<?php echo UPLOAD_PATH; ?>/admission-photo/<?php echo $admission->photo; ?>" alt="" width="70" />
                            <?php } ?>
                        </td>
                    </tr>                                    
                </tbody>
            </table>                
        </div>
        <div  class="tab-pane fade in " id="tab_guardian_info" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width="20%"><?php echo $this->lang->line('guardian'); ?></th>
                        <td width="30%"><?php echo $admission->gud_name; ?></td>
                        <th width="20%"><?php echo $this->lang->line('relation_with'); ?></th>
                        <td width="30%"><?php echo $this->lang->line($admission->gud_relation); ?></td>
                    </tr>                                                
                    <tr>
                        <th><?php echo $this->lang->line('phone'); ?></th>
                        <td><?php echo $admission->gud_phone; ?></td>   
                        <th><?php echo $this->lang->line('email'); ?></th>
                        <td><?php echo $admission->gud_email; ?></td>  
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?></th>
                        <td><?php echo $admission->gud_present_address; ?></td>                        
                        <th><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?></th>
                        <td><?php echo $admission->gud_permanent_address; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('religion'); ?></th>
                        <td><?php echo $admission->gud_religion; ?></td>  
                         <th><?php echo $this->lang->line('national_id'); ?></th>
                        <td><?php echo $admission->gud_national_id; ?></td>                        
                    </tr>
                    <tr>                        
                        <th><?php echo $this->lang->line('profession'); ?></th>
                        <td><?php echo $admission->gud_profession; ?></td>                                               
                        <th><?php echo $this->lang->line('other_info'); ?></th>
                        <td><?php echo $admission->gud_other_info; ?></td>                                               
                    </tr> 
                </tbody>
            </table>  
        </div>
        <div  class="tab-pane fade in " id="tab_parent_info" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width="20%"><?php echo $this->lang->line('father'); ?> <?php echo $this->lang->line('name'); ?></th>
                        <td width="30%"><?php echo $admission->father_name; ?></td>                       
                        <th width="20%"><?php echo $this->lang->line('mother'); ?> <?php echo $this->lang->line('name'); ?></th>
                        <td width="30%"><?php echo $admission->mother_name; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('father'); ?> <?php echo $this->lang->line('phone'); ?></th>
                        <td><?php echo $admission->father_phone; ?></td>                       
                        <th><?php echo $this->lang->line('mother'); ?> <?php echo $this->lang->line('phone'); ?></th>
                        <td><?php echo $admission->mother_phone; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('father'); ?> <?php echo $this->lang->line('education'); ?></th>
                        <td><?php echo $admission->father_education; ?></td>                       
                        <th><?php echo $this->lang->line('mother'); ?> <?php echo $this->lang->line('education'); ?></th>
                        <td><?php echo $admission->mother_education; ?></td>                       
                    </tr>                    
                    <tr>
                        <th><?php echo $this->lang->line('father'); ?> <?php echo $this->lang->line('profession'); ?></th>
                        <td><?php echo $admission->father_profession; ?></td>                       
                        <th><?php echo $this->lang->line('mother'); ?> <?php echo $this->lang->line('profession'); ?></th>
                        <td><?php echo $admission->mother_profession; ?></td>                       
                    </tr>
                    <tr>
                        <th><?php echo $this->lang->line('father'); ?> <?php echo $this->lang->line('designation'); ?></th>
                        <td><?php echo $admission->father_designation; ?></td>                       
                        <th><?php echo $this->lang->line('mother'); ?> <?php echo $this->lang->line('designation'); ?></th>
                        <td><?php echo $admission->mother_designation; ?></td>                       
                    </tr>                    
                </tbody>
            </table>  
        </div> 
    </div>
</div>

<style type="text/css">
    .table>thead>tr>th { padding: 2px 4px;}
    .table>tbody>tr>th { padding: 2px 4px;}    
    .table>tbody>tr>td { padding: 2px 4px;}    
</style>


