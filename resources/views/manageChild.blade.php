<?php
    //use App\Traits\UserHelper;
    //use UserHelper; 
?>
<ul>
    @foreach($childs as $child)

        <li>
            
                
                <?php
                    $arr=App\Helper\general::getUser($child->title);                    
                ?>
                        <a data-bs-html="true" href="javascript:void(0);"  data-bs-toggle="tooltip" title="<div class='row'><div class='col-lg-12'><div class='col-lg-12'><img class='img-thumbnail' width='200' src='{{ $arr['image'] }}' /></div><div class='col-lg-12'><div><span class='tool_heading'>Name : </span><span class='tool_text'>{{ $arr['name'] }}</span></div><div><span class='tool_heading'>PAN : </span><span class='tool_text'>{{ $arr['pan'] }}</span></div><div><span class='tool_heading'>Mobile : </span><span class='tool_text'>{{ $arr['phone'] }}</span></div><div><span class='tool_heading'><img class='img-thumbnail' alt='money-bag' width='30' src='../public/icons8-money-bag-rupee-100.png' /> : </span><span class='tool_text'>{{ $arr['amount_display'] }}</span></div></div></div></div>" style="margin: 5px; color:{{ $arr['color'] }}" >
                            {{ $child->title }}
                            </a> 
            
            @if(count($child->childs))

                @include('manageChild',['childs' => $child->childs])

            @endif

        </li>

    @endforeach

</ul>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>