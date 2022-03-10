<?php
header("Content-type:text/html;charset=utf-8");
/*
$count:总记录数
$page_size:每页显示的记录数
$num_btn:要展示的页码按钮数
$page:分页的参数
$page=page(100,10,6);
echo $page['html'];
*/
function page($count,$page_size,$num_btn,$page='page'){
    if(!isset($_GET[$page])||!is_numeric($_GET[$page])||$_GET[$page]<1){
        $_GET[$page]=1;
    }
    $page_num_all=ceil($count/$page_size);
    if($_GET[$page]>$page_num_all){
        $_GET[$page]=$page_num_all;
    }
    $start=($_GET[$page]-1)*$page_size;
    $limit="limit {$start},{$page_size}";
    
    $current_url=$_SERVER['REQUEST_URI'];//获取当前url的地址
    $arr_current=parse_url($current_url);//将url解析到数组里面
    $current_path=$arr_current['path'];//将文件路径部分保存起来
    //var_dump($arr_current);
    $url='';
    if(isset($arr_current['query'])){
        parse_str($arr_current['query'],$arr_query);
        unset($arr_query['$page']);
        //var_dump($arr_query);
        if(empty($arr_query)){
            $url="{$current_path}?{$page}=";
        }else{
            $other=http_build_query($arr_query);
            $url="{$current_path}?{$other}&{$page}=";
        }
    }else{
        $url="{$current_path}?{$page}=";
    }
    //var_dump($url);
    $html=array();
    if($num_btn>=$page_num_all){
        for($i=1;$i<=$page_num_all;$i++){//控制页码号，限制页码，$i为记录页码号
            if($_GET[$page]==$i){
                $html[$i]="<span>{$i}</span>";
            }else{
                $html[$i]="<a href='{$url}{$i}'>{$i}</a>";
            }
           
        }
    }else{
        $num_left=floor(($num_btn-1)/2);
        $start=$_GET[$page]-$num_left;
        $end=$start+($num_btn-1);
        if($start<1){
            $start=1;
        }
        if($end>$page_num_all){
            $start=$page_num_all-($num_btn-1);
        }
        for($i=0;$i<$num_btn;$i++){
            if($_GET[$page]==$start){
                $html[$start]="<span >{$start}</span>";
            }else{
                $html[$start]="<a href='{$url}{$start}'>{$start}</a>";
            }
            
            $start++;
        }
        //如果按钮数目大于等于三时候做省略效果
        if(count($html)>=3){
            reset($html);
            $key_first=key($html);
            end($html);
            $key_end=key($html);
            if($key_first!=1){
                array_shift($html);
                array_unshift($html,"<a href='{$url}1'>1...</a>");
            }
            if($key_end!=$page_num_all){
                array_pop($html);
                array_push($html,"<a href='{$url}{$page_num_all}'>...{$page_num_all}</a>");
            }
        }
       
    }
    if($_GET[$page]!=1){
        $prev=$_GET[$page]-1;
        array_unshift($html,"<a href='{$url}{$prev}'>&laquo;</a>");
    }
    if($_GET[$page]!=$page_num_all){
        $next=$_GET[$page]+1;
        array_push($html,"<a href='{$url}{$next}'>&raquo;</a>");
    }
    $html=implode(' ',$html);
    $data=array(
        'limit'=>$limit,
        'html'=>$html
    );
    return $data;
}
?>