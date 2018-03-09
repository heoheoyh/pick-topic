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

		?>
		<aside id='my' style='margin-bottom:2em'>
			<section>
				<h3 class="widget-title">
					<span>Today Topic</span>
				</h3>
				<div>
					<p><?php echo $instance['text'];?></p>
					<div onclick="pick();">Click Me!</div>
					<p id="result"></p>
					<script type="text/javascript">
						function pick(){
							var myArray = ["시금치", "콩나물", "아욱", "냉이"];
							var randomItem = myArray[Math.floor(Math.random()*myArray.length)];

							document.getElementById("result").innerHTML = randomItem;

							//$topics = array("시금치", "콩나물", "아욱", "냉이"); 
							//$selected = array_rand($topics);
							//echo $topics[$selected];
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
		$instance['text'] = $new_instance['text'];
		return $new_instance;
	}

	public function form($instance){
// $instance : 이전에 저장되어 있는 데이터값입니다.
		if( isset($instance['text'])) $text = $instance['text'];
		?>
		<br>
		text : <input type='text' id='<?php echo $this->get_field_id('text');?>' name='<?php echo $this->get_field_name('text');?>' value='<?php echo $text;?>' > <br><br>

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


