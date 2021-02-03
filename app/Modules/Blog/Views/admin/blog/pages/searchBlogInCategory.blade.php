@if(!empty($blogs))
    @foreach($blogs as $blog)
       <div class="col-12 border">
           <div class="row">
               <div class="col-1 pt-2">
                   <input type="radio" value="{{@$blog->id}}" class="addblog">
               </div>
               <div class="col-2 mt-1">
                    <img src="{{ asset('storage/editor/blog/'.@$blog->image) }}" alt="img-blog-detail" style="width:30px">
               </div>
               <div class="col-9 pt-2 title_{{@$blog->id}}">
                    {{@$blog->title}}
            </div>
           </div>
       </div>
    @endforeach
@else
Không tìm ra kết quả phù hợp
@endif

<script>
     $('.addblog').on('click', function(){
         var id = $(this).val();
         var StringCheck =  $('.load_blog_checked').html();
         if(StringCheck.indexOf("check_name"+id) != -1){
            console.log("da co roi");
            return false;
        }
        
         var x = document.createElement("INPUT");
            x.setAttribute("type", "hidden");
            x.setAttribute("class", "check_"+id);
            x.setAttribute("name", "blog[]");
            x.setAttribute("value", id);
            $('.load_blog_checked').append(x);

            var div_obj = document.createElement("span");
            div_obj.setAttribute("class", "check_name"+id);
            div_obj.innerHTML = $('.title_'+id).html();
            $('.load_blog_checked').append(div_obj);

            var div_obj = document.createElement("span");
            div_obj.setAttribute("class", "delete_blog");
            div_obj.setAttribute("onclick", "check("+id+")");
            div_obj.innerHTML ='X';
            $('.check_name'+id).append(div_obj);

            $('#search_blog').val('');
            $('.load_blog_search').html('');
        })
   
</script>