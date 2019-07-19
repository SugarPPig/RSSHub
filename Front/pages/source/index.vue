<template>
	<view class="">
		<view class=""><list-nav-bar :title="title"></list-nav-bar></view>
		<view class="container">
			<view class="page-body">
				<scroll-view class="nav-left" scroll-y :style="'height:' + height + 'px'">
					<view
						class="nav-left-item"
						@click="categoryClickMain(item, index)"
						:key="index"
						:class="index == categoryActive ? 'active' : ''"
						v-for="(item, index) in categoryList"
					>
						{{ item.NAME }}
					</view>
				</scroll-view>
				<scroll-view class="nav-right" scroll-y :scroll-top="scrollTop" @scroll="scroll" :style="'height:' + height + 'px'" scroll-with-animation>
					<view :id="index === 0 ? 'first' : ''" class="nav-right-item" v-for="(item, index) in subCategoryList" :key="item.ID" @click="getDetail(item.NAME)">
						<image :src="item.LOGO" />
						<view>{{ item.NAME }}</view>
					</view>
				</scroll-view>
			</view>
		</view>
	</view>
</template>

<script>
export default {
	data() {
		return {
			categoryList: [],
			subCategoryList: [],
			height: 0,
			categoryActive: 0,
			scrollTop: 0,
			scrollHeight: 0,
			name: '七月_',
			title: 'RSS源列表'
		};
	},
	methods: {
		scroll(e) {
			this.scrollHeight = e.detail.scrollHeight;
		},
		categoryClickMain(categroy, index) {
			this.categoryActive = index;
			this.subCategoryList = categroy.subCategoryList;
			this.scrollTop = -this.scrollHeight * index;
		},
		getCategory() {
			var all = uni.getStorageSync('all');
			if (!all) {
				this.$axios
					.get('http://tests.com/', {
						params: {
							// ID: 12345
						}
					})
					.then(function(response) {
						console.log(response);
						uni.setStorageSync('all', response['data']);
					})
					.catch(function(error) {
						console.log(error);
					});
				all = uni.getStorageSync('all');
			}

			for (var key in all) {
				var sub = [];
				for (var k in all[key]['sub-list']) {
					sub.push({
						ID: key + '' + k,
						NAME: k,
						LOGO: 'https://api.uomg.com/api/rand.avatar'
					});
				}
				this.categoryList.push({
					NAME: all[key]['title'],
					subCategoryList: sub
				});
			}

			this.subCategoryList = this.categoryList[0].subCategoryList;
		},
		getDetail(NAME) {
			uni.navigateTo({
				url: '/pages/source/detail?category=' + this.categoryList[this.categoryActive]['NAME'] + '&channel=' + NAME
			});
		}
	},
	onLoad: function() {
		this.getCategory();
		this.height = uni.getSystemInfoSync().windowHeight;
	}
};
</script>

<style>
.page-body {
	display: flex;
}

.nav {
	display: flex;
	width: 100%;
}

.nav-left {
	width: 30%;
}

.nav-left-item {
	height: 100upx;
	border-right: solid 1px #e0e0e0;
	border-bottom: solid 1px #e0e0e0;
	font-size: 30upx;
	display: flex;
	align-items: center;
	justify-content: center;
}

.nav-right {
	width: 70%;
}

.nav-right-item {
	width: 28%;
	height: 220upx;
	float: left;
	text-align: center;
	padding: 11upx;
	font-size: 28upx;
}

.nav-right-item image {
	width: 100upx;
	height: 100upx;
}

.active {
	color: #007aff;
}
</style>
