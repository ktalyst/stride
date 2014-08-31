<?php 
  /*
  |--------------------------------------------------------------------------
  | Styling the Error, warning and information messages
  |--------------------------------------------------------------------------
  |
  |
  |  #Usage in the controller
  |  ...->('message', Helper::notification('You have been logged in','success'));
  |
  |  #Usage in the view
  |    @if(Session::has('message'))
  |    {{Session::get('message')}}
  |  @endif
  |
  |
  */


class Helper{
    public static function notification($message,$type)
    {
      if($type == "success")
        {
            return '<div class="alert alert-'.$type.' alert-dismissable">
            <i class="fa fa-check"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Attention ! </b>'.$message.'</div>';
        }
        else if($type == "danger")
        {
            return '<div class="alert alert-'.$type.' alert-dismissable">
            <i class="fa fa-ban"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b>Attention ! </b>'.$message.'</div>';            
        }
    }
}


