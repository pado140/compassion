<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-book"></i><small> <?php echo $this->lang->line('manage'); ?> <?php echo $this->lang->line('e_book'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <strong><?php echo $this->lang->line('quick_link'); ?>:</strong>
                <?php if(has_permission(VIEW, 'library', 'book')){ ?>
                    <a href="<?php echo site_url('library/book/index/'); ?>"><?php echo $this->lang->line('manage_book'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'library', 'member')){ ?>
                   | <a href="<?php echo site_url('library/member/index/'); ?>"><?php echo $this->lang->line('library'); ?> <?php echo $this->lang->line('member'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'library', 'issue')){ ?>
                   | <a href="<?php echo site_url('library/issue/index'); ?>"><?php echo $this->lang->line('issue_and_return'); ?></a>                    
                <?php } ?>
                <?php if(has_permission(VIEW, 'library', 'ebook')){ ?>
                   | <a href="<?php echo site_url('library/ebook/index'); ?>"><?php echo $this->lang->line('e_book'); ?></a>                    
                <?php } ?>
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_book_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('e_book'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'library', 'ebook')){ ?>
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('library/ebook/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('e_book'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_book"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('e_book'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?> 
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_book"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('e_book'); ?></a> </li>                          
                        <?php } ?> 
                            
                            
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_book_list" >
                            <div class="x_content">
                                <div class="row">  
                                    <?php $count = 1; if(isset($ebooks) && !empty($ebooks)){ ?>
                                        <?php foreach($ebooks as $obj){ ?>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                              <div class="image view view-first">
                                                <img style="width: 100%; display: block;" src="<?php echo UPLOAD_PATH; ?>/ebook/<?php echo $obj->cover_image; ?>" alt="image" />
                                                <div class="mask">
                                                  <p><?php echo $obj->author; ?></p>
                                                  <div class="tools tools-bottom">
                                                    <?php if(has_permission(EDIT, 'library', 'ebook')){ ?>
                                                    <a title="editer les informations du livre" href="<?php echo site_url('library/ebook/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                                                <?php } ?>
                                                <?php if(has_permission(VIEW, 'library', 'ebook')){ ?>
                                                    <a  onclick="get_book_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-book-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-info"></i> </a>
                                                    <a  onclick="get_view_modal(<?php echo $obj->id; ?>);"  data-toggle="modal" data-target=".bs-view-modal-lg"  class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                                                    <?php if($obj->file_name){ ?>
                                                    <a target="_blank" href="<?php echo UPLOAD_PATH; ?>/ebook/<?php echo $obj->file_name; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> </a>
                                                    <?php  } ?>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'library', 'ebook')){ ?>
                                                    <a href="<?php echo site_url('library/ebook/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>
                                                <?php } ?>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="caption">
                                                <p><?php echo $obj->name; ?></p>
                                              </div>
                                            </div>
                                          </div>
                                        
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_book">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('library/ebook/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('e_book'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($post['name']) ?  $post['name'] : ''; ?>" placeholder="<?php echo $this->lang->line('e_book'); ?> <?php echo $this->lang->line('title'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                                                   
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edition"><?php echo $this->lang->line('edition'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="edition"  id="edition" value="<?php echo isset($post['edition']) ?  $post['edition'] : ''; ?>" placeholder="<?php echo $this->lang->line('edition'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('edition'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="author"><?php echo $this->lang->line('author'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="author"  id="author" value="<?php echo isset($post['author']) ?  $post['author'] : ''; ?>" placeholder="<?php echo $this->lang->line('author'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('author'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="language"><?php echo $this->lang->line('language'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="language"  id="language" value="<?php echo isset($post['language']) ?  $post['language'] : ''; ?>" placeholder="<?php echo $this->lang->line('language'); ?>"  type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('language'); ?></div>
                                    </div>
                                </div>
                                                                  
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('cover_image'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="cover_image"  id="cover_image" type="file">
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                        <div class="help-block"><?php echo form_error('cover_image'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('e_book'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="file_name"  id="file_name" type="file" >
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('file_name'); ?></div>
                                    </div>
                                </div>
                                                          
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('library/ebook'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_book">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('library/ebook/edit/'.$ebook->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('e_book'); ?> <?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($ebook->name) ?  $ebook->name : ''; ?>" placeholder="<?php echo $this->lang->line('e_book'); ?> <?php echo $this->lang->line('name'); ?>" required="required" type="text" autocomplete="off">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edition"><?php echo $this->lang->line('edition'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="edition"  id="edition" value="<?php echo isset($ebook->edition) ?  $ebook->edition : ''; ?>" placeholder="<?php echo $this->lang->line('edition'); ?>" type="text" autocomplete="off"/>
                                        <div class="help-block"><?php echo form_error('edition'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="author"><?php echo $this->lang->line('author'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="author"  id="author" value="<?php echo isset($ebook->author) ?  $ebook->author : ''; ?>" placeholder="<?php echo $this->lang->line('author'); ?>" type="text" autocomplete="off"/>
                                        <div class="help-block"><?php echo form_error('author'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="language"><?php echo $this->lang->line('language'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="language"  id="language" value="<?php echo isset($ebook->language) ?  $ebook->language : ''; ?>" placeholder="<?php echo $this->lang->line('language'); ?>" type="text" autocomplete="off"/>
                                        <div class="help-block"><?php echo form_error('language'); ?></div>
                                    </div>
                                </div>
                                                          
                                                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('cover_image'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_cover_image" id="prev_cover_image" value="<?php echo $ebook->cover_image; ?>" />
                                        <?php if($ebook->cover_image){ ?>
                                        <img src="<?php echo UPLOAD_PATH; ?>/ebook/<?php echo $ebook->cover_image; ?>" alt="" width="70" /><br/><br/>
                                        <?php } ?>
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="cover_image"  id="cover_image" type="file">
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                        <div class="help-block"><?php echo form_error('cover_image'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('e_book'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_file_name" id="prev_file_name" value="<?php echo $ebook->file_name; ?>" />
                                        <?php if($ebook->file_name){ ?>
                                            <a target="_blank" href="<?php echo UPLOAD_PATH; ?>/ebook/<?php echo $ebook->file_name; ?>"><?php echo $ebook->file_name; ?></a> <br/><br/>
                                        <?php } ?>
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="file_name"  id="file_name" type="file">
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('file_name'); ?></div>
                                    </div>
                                </div>
                                                         
                                                                                           
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($ebook) ? $ebook->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('library/ebook'); ?>"  class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-book-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('e_book'); ?> <?php echo $this->lang->line('information'); ?></h4>
        </div>
        <div class="modal-body fn_book_data"></div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_book_modal(ebook_id){
         
        $('.fn_book_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('library/ebook/get_single_ebook'); ?>",
          data   : {ebook_id : ebook_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_book_data').html(response);
             }
          }
       });
    }
</script>

<div class="modal fade bs-view-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><?php echo $this->lang->line('read'); ?> <?php echo $this->lang->line('e_book'); ?></h4>
        </div>
        <div class="modal-body fn_read_book_data"></div>       
      </div>
    </div>
</div>
<script type="text/javascript">
         
    function get_view_modal(ebook_id){
         
        $('.fn_read_book_data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></p>');
        $.ajax({       
          type   : "POST",
          url    : "<?php echo site_url('library/ebook/get_single_read_ebook'); ?>",
          data   : {ebook_id : ebook_id},  
          success: function(response){                                                   
             if(response)
             {
                $('.fn_read_book_data').html(response);
             }
          }
       });
    }
</script>


 
 <script type="text/javascript">
        $(document).ready(function() {
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
              search: true,              
              responsive: true
          });
        });
        
    $("#add").validate();     
    $("#edit").validate();
</script>