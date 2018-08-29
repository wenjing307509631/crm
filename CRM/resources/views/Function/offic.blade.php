<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="index/css/font.css">
    <link rel="stylesheet" href="index/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/index/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/index/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
            <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start">
            <input class="layui-input" placeholder="截止日" name="end" id="end">
            <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('用户共享','/share_user_do')"><i class="layui-icon"></i>共享</button>
        {{--<span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>--}}
    </xblock>
    <table class="layui-table">
        <thead>

        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>客户姓名</th>
            <th>联系电话</th>
            <th>省</th>
            <th>市</th>
            <th>县</th>
            <th>详细地址</th>
            <th>备用电话</th>
            <th>网络</th>
            <th>客户类型</th>
            <th>客户等级</th>
            <th>客户来源</th>
            <th>其他联系</th>
            <th>主营项目</th>
            <th>备注</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>

        @foreach($res as $v)
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>{{$v->user_id}}</td>
                <td>{{$v->user_name}}</td>
                <td>{{$v->tel}}</td>
                <td>{{$v->area}}</td>
                <td>{{$v->part}}</td>
                <td>{{$v->xian}}</td>
                <td>{{$v->addr}}</td>
                <td>{{$v->back_tel}}</td>
                <td>{{$v->ip}}</td>
                <td>{{$v->type}}</td>
                <td>{{$v->lv}}</td>
                <td>{{$v->source}}</td>
                <td>{{$v->o_tel}}</td>
                <td>{{$v->project}}</td>
                <td>{{$v->remark}}</td>
                <td class="td-status">
                    <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
                <td class="td-manage">
                  <!--  <a title="修改"  onclick="x_admin_show('修改','/offup?id={{$v->user_id}}')" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a> -->
                    <a title="删除"  onclick="x_admin_show2('删除','{{$v->user_id}}')" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="page">
        <div>
            {{$res}}
        </div>
    </div>
</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });
	function x_admin_show2(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              
			    $.ajax({
                      type: 'get',
                      dataType: "json",
                      data:{id:id},
                      url: "/offdel",
                      success: function (datas) {
//                          console.log(data);
                          if (datas.code == 1) {
                              
	
                                   $(obj).parents("tr").remove();
								   layer.msg(datas.font,{icon:1,time:1000});
								window.location.reload();
					var index = parent.layer.getFrameIndex(window.name);
					parent.layer.close(index);
                          } else {
                              layer.msg(datas.font, {icon: datas.code});
                          }
                      }

                  })

             
          });
      }
	  
    /*用户-停用*/
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){

            if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

            }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
            }

        });
    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }



    function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>


</body>

</html>
