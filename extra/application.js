(function($){
    $(document).ready(function(){
        var initData = function(params){

            var url = '';
            if(!params){
                url = './data?q=init';
            }else{
                url = './data?q=init&p='+params.page;
            }

            $.ajax({url: url, dataType: 'json', type: 'POST', success: function (data) {
                $('#main').empty();
                console.log(data)
                var html = '';
                if(data){
                    for(var oo in data['post']){
                        html += '<div class="post span3" data-id="'+data['post'][oo]['id']+'"><div class="inner"><span class="link" title="点击浏览">+</span><div class="img-box"><img width="100%" height="100%" src="'+data['post'][oo]['url']+'" alt="图片描述"/></div><div class="caption"><h2>'+data['post'][oo]['title']+':</h2><p>'+data['post'][oo]['desc']+'</p></div></div></div>';
                    }
                    window.page = data.page;
                }

                html += '<div class="post span3" id="pagination"><div class="inner"><span class="meta">页码</span><div id="pages"><span class="cur">'+data['page']['cur']+'</span> of <span class="total">'+data['page']['total']+'</span></div><div class="page-nav"><a href="#CMD:PREV">上一页 +</a><a href="#CMD:NEXT">下一页 +</a></div></div></div>';

                $('#main').append(html);

            }
            });
        }
        initData();

        var initBtns = function(){
            var body = $('body');
            body.on('click',function(e){
                var target = $(e.target);
                if(target.closest('a[href^=#CMD]')){
                    e.preventDefault();
                    var cmd = target.attr('href');
                    if (cmd) {
                        cmd = cmd.split('#CMD:')[1];

                        switch (cmd){
                            case 'NEXT':
                                initData({page:window.page.next})
                                break;
                            case 'PREV':
                                initData({page:window.page.prev})
                                break;
                            case 'HOME':
                                initData()
                                break;
                        }
                        console.log(cmd);
                    }
                }
            })
        }
        initBtns();

    });
})(jQuery,"http://soulteary.com")
