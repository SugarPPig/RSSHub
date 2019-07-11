<template>
	<view class="">
		<view class="" v-if="hideccc"><list-nav-bar ref="funcc" :title="title"></list-nav-bar></view>
		<view class="">这是首页</view>
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
			hideccc: true,
			title: '首页'
		};
	},
	onLoad() {
	},
	onShow() {
		this.hideccc = true
	},
	onReady(){
	},
	onHide() {
	},
	onUnload() {
		this.hideccc = false
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

</style>
