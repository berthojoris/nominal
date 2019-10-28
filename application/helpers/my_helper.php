<?php

if(!function_exists('add_js')){
    function add_js($file='')
    {
        $str = '';
        $ci = &get_instance();
        $bottom_js = $ci->config->item('bottom_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $bottom_js[] = $item;
            }
            $ci->config->set_item('bottom_js',$bottom_js);
        }else{
            $str = $file;
            $bottom_js[] = $str;
            $ci->config->set_item('bottom_js',$bottom_js);
        }
    }
}

if(!function_exists('add_css')){
    function add_css($file='')
    {
        $str = '';
        $ci = &get_instance();
        $bottom_js = $ci->config->item('bottom_js');

        if(empty($file)){
            return;
        }

        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            foreach($file AS $item){
                $bottom_js[] = $item;
            }
            $ci->config->set_item('bottom_js',$bottom_js);
        }else{
            $str = $file;
            $bottom_js[] = $str;
            $ci->config->set_item('bottom_js',$bottom_js);
        }
    }
}

if(!function_exists('put_bottom')){
    function put_bottom()
    {
        $str = '';
        $ci = &get_instance();
        $bottom_js = $ci->config->item('bottom_js');

        foreach($bottom_js as $item){
            $str .= '<script type="text/javascript" src="'.base_url().'assets/js/'.$item.'"></script>'."\n";
        }

        return $str;
    }
}

function show_msg($content='', $type='success', $icon='fa-info-circle', $size='14px') {
    if ($content != '') {
        return  '<p class="box-msg">
            <div class="info-box alert-' .$type .'">
                <div class="info-box-icon">
                <i class="fa ' .$icon .'"></i>
                </div>
                <div class="info-box-content" style="font-size:' .$size .'">
                ' .$content
            .'</div>
            </div>
        </p>';
    }
}

function show_succ_msg($content='', $size='14px') {
    if ($content != '') {
        return '<p class="box-msg">
            <div class="info-box alert-success">
                <div class="info-box-icon">
                <i class="fa fa-check-circle"></i>
                </div>
                <div class="info-box-content" style="font-size:' .$size .'">
                ' .$content
            .'</div>
            </div>
        </p>';
    }
}

function show_err_msg($content='', $size='14px') {
    if ($content != '') {
        return   '<p class="box-msg">
            <div class="info-box alert-error">
                <div class="info-box-icon">
                <i class="fa fa-warning"></i>
                </div>
                <div class="info-box-content" style="font-size:' .$size .'">
                ' .$content
            .'</div>
            </div>
        </p>';
    }
}

function show_my_modal($content='', $id='', $data='', $size='md') {
    $_ci = &get_instance();

    if ($content != '') {
        $view_content = $_ci->load->view($content, $data, TRUE);

        return '<div class="modal fade" id="' .$id .'" role="dialog">
            <div class="modal-dialog modal-' .$size .'" role="document">
            <div class="modal-content">
                ' .$view_content .'
            </div>
            </div>
        </div>';
    }
}

function show_my_confirm($id='', $class='', $title='Konfirmasi', $yes = 'Ya', $no = 'Tidak') {
    $_ci = &get_instance();

    if ($id != '') {
        echo   '<div class="modal fade" id="' .$id .'" role="dialog">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
                    <h3 style="display:block; text-align:center;">' .$title .'</h3>
                    
                    <div class="col-md-6">
                    <button class="form-control btn btn-primary ' .$class .'"> <i class="glyphicon glyphicon-ok-sign"></i> ' .$yes .'</button>
                    </div>
                    <div class="col-md-6">
                    <button class="form-control btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ' .$no .'</button>
                    </div>
                </div>
            </div>
            </div>
        </div>';
    }
}
?>
