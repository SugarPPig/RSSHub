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
					<view :id="index === 0 ? 'first' : ''" class="nav-right-item" v-for="(item, index) in subCategoryList" :key="item.ID" @click="getDetail(index)">
						<image :src="item.LOGO" />
						<view>{{ item.NAME }}</view>
					</view>
				</scroll-view>
			</view>
		</view>
	</view>
</template>

<script>
function count(o) {
	var t = typeof o;

	if (t == 'string') {
		return o.length;
	} else if (t == 'object') {
		var n = 0;

		for (var i in o) {
			n++;
		}

		return n;
	}
	return false;
}

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
			var list = [
				'社交媒体',
				'编程',
				'直播',
				'音视频',
				'图片',
				'二次元',
				'程序更新',
				'大学通知',
				'传统媒体',
				'预报预警',
				'出行旅游',
				'购物',
				'游戏',
				'小说·文学·阅读',
				'政务消息',
				'其他'
			];

			var subList = [
				[
					{
						web: 'bilibili',
						list: [
							['\u756a\u5267', 'https:\/\/rsshub.app\/bilibili\/bangumi\/media\/9192'],
							['UP\u4e3b\u6295\u7a3f', 'https:\/\/rsshub.app\/bilibili\/user\/video\/2267573']
						]
					},
					{
						web: 'Dcard',
						list: [
							['\u9996\u9801\u5e16\u5b50', 'https:\/\/rsshub.app\/dcard\/posts\/popular'],
							['\u677f\u584a\u5e16\u5b50', 'https:\/\/rsshub.app\/dcard\/funny\/popular']
						]
					}
				],
				[{ web: 'AI\u7814\u4e60\u793e', list: [['\u9996\u9875', 'https:\/\/rsshub.app\/aiyanxishe\/109\/hot']] }]
			];

			// console.log(subList);
			
			for (var i = 0; i < list.length; i++) {
				var sub = [];
				for (var j = 0; j < count(subList[i]); j++) {
					sub.push({
						ID: i + '' + j,
						NAME: subList[i][j]['web'],
						LOGO: 'https://api.uomg.com/api/rand.avatar'
					});
				}
				this.categoryList.push({
					NAME: list[i],
					subCategoryList: sub
				});
			}
			
			uni.setStorageSync('list',list);
			uni.setStorageSync('subList',subList);
			
			this.subCategoryList = this.categoryList[0].subCategoryList;
		},
		getDetail(index) {
			uni.navigateTo({
				url: '/pages/source/detail?category' + '=' + this.categoryActive + '&sub=' + index
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
