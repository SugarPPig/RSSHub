<template>
	<view>
		<view>
			<view class="">
				<list-nav-bar :title="title"></list-nav-bar>
			</view>
		</view>
		<view>
			<view>
				<h1>{{array['sub']}}</h1>
				<view>{{array['url']}}</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		components: {},
		data() {
			return {
				title: '',
				array: [],
			};
		},
		onLoad() {
			let id = this.$route.query['id'];
			this.getDetail(id);
		},
		methods: {
			getDetail(id) {
				this.$axios
					.get('http://tests.com/', {
						params: {
							route: 'rss/detail',
							id: id
						}
					})
					.then(response => {
						this.array = response.data;
						this.title = this.array['title'];
					})
					.catch(function(error) {
						console.log(error);
					});
			}
		}
	}
</script>

<style>
</style>
