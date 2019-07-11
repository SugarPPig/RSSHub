<template>
	<view class="">
		<view class=""><list-nav-bar :title="title"></list-nav-bar></view>
		<view class="">
			<uni-list>
				<uni-list-item :show-arrow="false" title="标题文字" note="描述信息" />
				<uni-list-item title="标题文字" note="描述信息" />
				<uni-list-item :show-badge="true" :badge-text="2222" title="标题文字" note="描述信息" />
			</uni-list>
		</view>
	</view>
</template>

<script>
import UniList from '@/node_modules/@dcloudio/uni-ui/lib/uni-list/uni-list.vue';
import uniListItem from '@/node_modules/@dcloudio/uni-ui/lib/uni-list-item/uni-list-item.vue';

export default {
	components: {
		UniList,
		uniListItem
	},
	data() {
		return {
			title: 'RSS路由列表'
		};
	},
	onReady() {
	},
	methods: {
	},
	onPullDownRefresh() {
		console.log('onPullDownRefresh');
		setTimeout(function() {
			uni.stopPullDownRefresh();
			console.log('stopPullDownRefresh');
		}, 1000);
	}
};
</script>

<style>
.content {
	text-align: center;
	height: 400upx;
}

.logo {
	height: 200upx;
	width: 200upx;
	margin-top: 200upx;
}

.title {
	font-size: 36upx;
	color: #8f8f94;
}
</style>
