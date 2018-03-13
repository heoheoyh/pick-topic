<?php
/*
Plugin Name: Just Heo
Plugin URI: http://wordpress.org/plugins/heo/
Description: This is just Heo's plugin. 
Author: yunhee
Version: 0.1
Author URI: http://13.231.159.88/
*/

class todayTopic extends WP_Widget{

	function __construct(){
		parent::__construct(
 			'my', // 현재 생성하는 위젯의 ID 값입니다. 
			'Today Topic', // 설정 페이지에서 보여지게 되는 위젯의 이름입니다.
			array('description' => '오늘의 토픽을 선택해서 글을 써봅시다. 뭐가 나올지 몰라요 ~.~ ')
				//설정페이지에서 보여지게 되는 위젯의 설명글입니다. array('description'= > '설명글')임을 확인하세요!
		);
	}

	public function widget($args, $instance){
// $args : 위젯의 타이틀/위젯과 관련된 필터 훅과 연계된 데이터가 $args 매개변수에 저장됩니다.
// $instance : $instance 에서는 Update() 메서드를 통해 저장된 데이터를 가지고 있는 변수입니다. 
		wp_enqueue_style( 'style', plugins_url('heo.css', __FILE__) );
		?>
		<aside id='my' style='margin-bottom:2em'>
			<section>
				<h3 class="widget-title">
					<span>Today Topic</span>
				</h3>
				<div>
					<h3><?php echo $instance['title'];?></h3>

					<?php if($instance['radio'] == 'textType') : ?>
						<div id="pick" onclick="pick()">
							<p>Today Topic! Click Me!</p>
						</div>
						<div id="pick2" style="display: none;">
							<p id="result"></p>
						</div>
					<?php elseif($instance['radio'] == 'imgType') : ?>
						<div class="container">
							<div class='img'></div>
							<div class="foo" style="display: none;">Click Me!</div>
						</div>
					<?php endif; ?>


					<script type="text/javascript">
						var myArray = ['삶', '봄', '여행', '사진', '곰', '휴식'];
						
						function pick(){
							
							var selected = myArray[Math.floor(Math.random()*myArray.length)];

							//document.getElementById('pick2').style.display = 'none';
							document.getElementById('pick').style.display = 'none';
							//document.getElementById('pick').classList.remove('pick2');
							document.getElementById('pick2').style.display = 'block';
							document.getElementById("result").innerHTML = selected;

						}

						document.getElementsByClassName("container")[0].addEventListener("click", ok);
						function ok() {
							var selected = myArray[Math.floor(Math.random()*myArray.length)];

							document.getElementsByClassName("foo")[0].style.display = 'block';
							document.getElementsByClassName("foo")[0].innerHTML = selected;

							document.getElementsByClassName("container")[0].removeEventListener("click", ok);
						}
					</script>
				</div>
			</section>
		</aside>
		<?php

	}


	public function update($new_instance, $old_instance){
// $new_instance : 위젯 설정 페이지에서 저장된 새로운 데이터값입니다.
// $old_instance : 현재 저장된 설정 이전에 저장된 데이터값입니다.

		$instance = array();
		$instance['title'] = $new_instance['title'];
		$instance['textType'] = $new_instance['textType'];
		$instance['imgType'] = $new_instance['imgType'];
		$instance['radio'] = $new_instance['radio'];
		return $new_instance;
	}

	public function form($instance){
// $instance : 이전에 저장되어 있는 데이터값입니다.
		if( isset($instance['title'])) $title = $instance['title'];
		if( isset($instance['textType'])) $textType = $instance['textType'];
		if( isset($instance['imgType'])) $imgType = $instance['imgType'];
		if( isset($instance['radio'])) $radio= $instance['radio'];
		?>
		<br>
		Title : <input type='text' id='<?php echo $this->get_field_id('title');?>' name='<?php echo $this->get_field_name('title');?>' value='<?php echo $title;?>' > <br><br>

		Display type <br>
		text : <input type='radio' id='<?php echo $this->get_field_id('textType')?>' name='<?php echo $this->get_field_name('radio')?>' value='textType' <?php if($radio === 'textType') echo 'checked' ?> ><br>
		image : <input type='radio' id='<?php echo $this->get_field_id('imgType')?>' name='<?php echo $this->get_field_name('radio')?>' value='imgType' <?php if($radio === 'imgType') echo 'checked' ?> ><br>
		<?php
// $this->get_field_name('animate_sec')
// $this->get_field_id('animate_sec')
// 메서드를 사용하여 form을 생성하고 있음을 유의하세요.
	}

}

function my_register(){
	register_widget('todayTopic');
}

add_action('widgets_init', 'my_register');

?>


