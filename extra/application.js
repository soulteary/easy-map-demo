(function($){
    $(document).ready(function(){
        var initData = function(params){

            var url = '';
            if(!params){
                url = './data?q=init';
            }else{
                url = './data?q=init&bus='+params.bus;
            }

            $.ajax({url: url, dataType: 'json', type: 'POST', success: function (data) {
                console.log(data)
                $('#route-table').find('tbody tr').remove();
                var html = '';
                var status = '';
                for(var bus in data){
                    html+='<tr><td>'+(parseInt(bus)+1)+'</td><td><span class="label label-info">'+data[bus]['bus']+'</span></td><td><span class="detail"><span class="badge badge-info">'+data[bus]['path']+'</span></span></span></td><td>';
                    if(data[bus]['status']=='空闲'){
                        status = 'success';
                    }else{
                        status = 'important';
                    }
                    html+='<span class="status busy"><span class="badge badge-'+status+'">'+data[bus]['status']+'</span></td><td><span class="time"><span class="badge badge-info">'+data[bus]['time']+'</span></td></tr>';
                }
                $('#route-table tbody').append(html);

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
                            case 'SEARCH':
                                initData({bus:$('#search-query').val().trim()})
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
