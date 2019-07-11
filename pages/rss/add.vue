<template>
	<view class="">
		<view class="">
			<view><list-nav-bar :title="title"></list-nav-bar></view>
		</view>
		<view class="">
			<form @submit.prevent="formSubmit" @reset="formReset">
				<view>
					<view class="uni-title">姓名</view>
					<view class="uni-list">
						<view class="uni-list-cell"><input class="uni-input" name="nickname" placeholder="请填写您的昵称" /></view>
					</view>
				</view>
				<view>
					<view class="uni-title">性别</view>
					<radio-group class="uni-flex" name="gender">
						<label>
							<radio value="男" />
							男
						</label>
						<label>
							<radio value="女" />
							女
						</label>
					</radio-group>
				</view>
				<view>
					<view class="uni-title">爱好</view>
					<checkbox-group class="uni-flex" name="loves">
						<label>
							<checkbox value="读书" />
							读书
						</label>
						<label>
							<checkbox value="写字" />
							写字
						</label>
					</checkbox-group>
				</view>
				<view class="uni-btn-v uni-common-mt">
					<button class="btn-submit" formType="submit" type="primary">Submit</button>
					<button type="default" formType="reset">Reset</button>
				</view>
			</form>
		</view>
	</view>
</template>

<script>
import uniDrawer from '@dcloudio/uni-ui/lib/uni-drawer/uni-drawer.vue';
import uniList from '@dcloudio/uni-ui/lib/uni-list/uni-list.vue';
import uniListItem from '@dcloudio/uni-ui/lib/uni-list-item/uni-list-item.vue';
import Vue from 'vue';
var graceChecker = require('../../js_sdk/graceui-dataChecker/graceChecker.js');

export default {
	components: {
		uniList,
		uniListItem
	},
	data() {
		return {
			title: '订阅RSS'
		};
	},
	onLoad() {},
	methods: {
		formSubmit: function(e) {
			//将下列代码加入到对应的检查位置
			//定义表单规则
			var rule = [
				{ name: 'nickname', checkType: 'string', checkRule: '1,3', errorMsg: '姓名应为1-3个字符' },
				{ name: 'gender', checkType: 'in', checkRule: '男,女', errorMsg: '请选择性别' },
				{ name: 'loves', checkType: 'notnull', checkRule: '', errorMsg: '请选择爱好' }
			];
			//进行表单检查
			var formData = e.detail.value;
			var checkRes = graceChecker.check(formData, rule);
			if (checkRes) {
				uni.showToast({ title: '验证通过!', icon: 'none' });
				uni.setStorageSync('formData', JSON.stringify(formData));
			} else {
				uni.showToast({ title: graceChecker.error, icon: 'none' });
			}
		},
		formReset: function(e) {
			console.log('清空数据');
			// this.chosen = '';
			let formData = uni.getStorageSync('formData');
			console.log(formData);
		}
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
page {
	height: auto;
	min-height: 100%;
}

.uni-card {
	box-shadow: none;
}

.uni-list:after {
	height: 0;
}

.uni-list:before {
	height: 0;
}

.uni-hello-text {
	word-break: break-all;
}

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

.nav {
	/* width: 80%; */
	/* margin:0 auto; */
}

.tab-left {
	margin-top: 88upx;
}
</style>
