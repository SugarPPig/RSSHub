<template>
	<view class="">
		<view class=""><list-nav-bar :title="title"></list-nav-bar></view>
		<view class="" v-for="(item,index) in this.item['list']" :key='index'>
			<h2>{{item[0]}}</h2>
			<view>{{item[1]}}</view>
		</view>
	</view>
</template>

<script>

export default {
	components: {
	},
	data() {
		return {
			list: '',
			subList: '',
			item: '',
			title: ''
		};
	},
	onLoad() {
		this.getCategory();
		this.item = this.subList[this.$route.query['category']][this.$route.query['sub']];
		this.title = this.list[this.$route.query['category']] + '_' + this.item['web']
		console.log(this.item['list'])
	},
	methods: {
		getCategory(){
			this.list = uni.getStorageSync('list');
			this.subList = uni.getStorageSync('subList');
		}
	}
};
</script>

<style>
</style>
