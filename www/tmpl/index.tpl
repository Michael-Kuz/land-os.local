<div class="fancy-box-parent">
	<div class="fancy-box-background">
		<div class="close-popup">
			<img src="images/but_close.png" alt="Закрыть">
		</div>
		<img src="" alt=""/>
	</div>
</div>
<div class="header">
	<div id="h1">
		<h1><?=$title?></h1>
	</div>
	<img class="pic-header-1" src="images/header_pic1.png" alt="" title="" />
	<?=$top_form?>
</div>
<div class="success">
</div>
<div id="advantages">
	<h2><?=reset($items_adv)->section_title?></h2>
	<div class="adv-wrap">
		<?php foreach( $items_adv as $item ) { ?>
			<div class="item-advnt" >
				<div class="item-hover">
					<div class="circle-icon">
						<img src="<?=$item->icon?>" alt="<?=$item->title?>" title="<?=$item->title?>" />
					</div>
					<p><?=$item->title?></p>
					<hr/>
					<?php if( $item->intro ) { ?>
						<p><?=$item->intro?></p>
					<?php } ?>
				</div>
				<div class="circle-icon wow">
					<img src="<?=$item->icon?>" alt="<?=$item->title?>" title="<?=$item->title?>" />
				</div>
				<p><?=$item->title?></p>
			</div>
		<?php } ?>
	</div>
</div>
<div id="steps">
	<h2><?=reset($items_stp)->section_title?></h2>
	<div class="adv-wrap">
		<?php foreach( $items_stp as $item ) { ?>
			<div class="item-steps" >
				<div class="item-hover">
					<div class="circle-icon">
						<img src="<?=$item->icon?>" alt="<?=$item->title?>" title="<?=$item->title?>" />
					</div>
					<p><?=$item->title?></p>
					<hr/>
					<?php if( $item->intro ) { ?>
						<p><?=$item->intro?></p>
					<?php } ?>
				</div>
				<div class="circle-icon wow">
					<img src="<?=$item->icon?>" alt="<?=$item->title?>" title="<?=$item->title?>" />
				</div>
				<p><?=$item->title?></p>
			</div>
		<?php } ?>
	</div>
</div>
<div id="separator">
	<p>Остались вопросы?</p>
	<p>Воспользуйтесь бесплатной консультацией!</p>
	<button class="button-1" data-hover="Оформить консультацию" >Оформить консультацию</button>
</div>
<div id="efficiency">
	<h2><?=reset($items_eff)->section_title?></h2>
	<div class="adv-wrap">
		<?php foreach( $items_eff as $item ) { ?>
			<div class="item-effic" >
				<div class="item-hover">
					<div class="circle-icon">
						<img src="<?=$item->icon?>" alt="<?=$item->title?>" title="<?=$item->title?>" />
					</div>
					<p><?=$item->title?></p>
					<hr/>
					<?php if( $item->intro ) { ?>
						<p><?=$item->intro?></p>
					<?php } ?>
				</div>
				<div class="circle-icon wow">
					<img src="<?=$item->icon?>" alt="<?=$item->title?>" title="<?=$item->title?>" />
				</div>
				<p><?=$item->title?></p>
			</div>
		<?php } ?>
	</div>
</div>
<!--
<div id="works">
	<h2>Работы и цены</h2>
	<div class="works-wrap">
		<div class="slider-win wow">
			<ul>
				<?php $i=0; foreach( $items_works as $item ) { $i++;?>
					<li class="slide-<?=$i?>">
						<div class="item-works">
							<div class="icon-work">	
								<img src="<?=$item->icon?>"  data-img="<?=$item->full_img?>" alt="<?=$item->title?>" />
							</div>
							<div class="reference">
								<div class="v-separator" ></div>
								<div class="statistics">
									<p>Цена разработки <strong><?=$item->price?> рублей</strong></p>
									<p>Цена заявки <strong><?=$item->bid?> рублей</strong></p>
									<p>Число заявок в неделю <strong><?=$item->n_per_week?></strong></p>
								</div>
							</div>
						</div>
					</li>
				<?php } ?>
			</ul>
		</div>
		<nav>
			<div class="arrow-left"><img src="images/arrow_left.png" alt="" title="" /></div>
			<div class="arrow-right"><img src="images/arrow_right.png" alt="" title="" /></div>
		</nav>
	</div>
</div>
-->
<div id="guarantee">
	<h2><?=reset($items_guar)->section_title?></h2>
	<div class="adv-wrap flex-v-align wow">
		<div class="v-separator" ></div>
		<div class="guar-items">
			<?=reset($items_guar)->intro?>
		</div>
	</div>
</div>
<?=$bottom_form?>
<?php if( $_SESSION["split"] == "anima" ) { ?>
	<script>
		ini_animation();
	</script>
<?php } ?>
		