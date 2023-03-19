Word 是一款专为文字创作而生，又简而不凡的全新 typecho 主题。

### 主题相关

- QQ交流群：345655679
- 效果预览：https://xwsir.cn
- 主题宗旨：简洁、超强、开源、精华
- 主题适配后台美化插件: [WordStyle](https://gitee.com/dinphy/WordStyle)
- 延续 Joe 主题相关功能，具有丰富的短代码

### 主题亮点

```html
全新页面布局，从简设计
说说页面时间轴设计
留言页面用户排行榜
友链页面分首页和内页显示
归档页面手风琴设计
支持文章列表点赞
支持导航栏分类合并、页面合并
支持自定义页面 Batten 图
支持移动端页脚自定义链接
支持默认、单图、三图、无图和闲谈五种文章模式
支持文章代码高亮
支持评论贴图、私密
支持侧栏开关
支持前台用户登录
……
```

![1][1]

![2][2]

![3][3]

![4][4]

![5][5]

### 主题开发

1. 开发时请使用 `VSCode编辑器` ，编辑器插件：`scss-to-css`（根据官方文档进行下载依赖库） 和 `minify`
2. css代码由scss编译成.min.css文件
3. js代码由minify压缩成.min.js文件

### 主题目录介绍（非实时）

├── assets 主题静态资源

├── core 主题核心文件夹

├── library 主题内集成第三方库

├── public 共用的一些模块文件

├── typecho

│      ├── config 主题外观、功能设置的样式脚本目录

├── 404.php 404页面

├── archive.php 搜索页面

├── friends.php 友情链接页面

├── cross.php 说说页面（卡片）

├── dynamic.php 说说页面（时间轴）

├── functions.php 主题的外观、功能设置

├── index.php 博客首页页面

├── leaving.php 留言板页面

├── live.php 虎牙直播页面

├── page.php 独立页面

├── post.php 文章页面

├── screenshot.php 主题截图图片

├── video.php 全网影视页面

└── wallpaper.php 壁纸页面

#### Joe 扩版亮点:

```html
1. 在保持原版功能、结构和风格的基础上，扩展新功能或微调。
2. 增加文章目录树
3. 增加闲话模式
4. 增加动态页面
5. 增加文章宽屏阅读
6. 增加滚动时导航栏显示隐藏，文章页为标题
7. 增加侧边栏导航页面数超过限制数时显示更多
8. 增加前端登录
9. 修改文章页编辑内容/页面为图标
10. 修改a标签的href属性值
11. 更新JOE编辑器为白色系并精简编辑器工具栏图标（短代码功能还在）
```

#### 扩版使用指南：

- 最终提交记录：[Joe 扩版终结了](https://github.com/dinphy/Word/commit/285511977dbb0241ccf03a850fd3e85a392a8a9a)
- 使用时将文件夹改名为：Joe

 [1]: https://xwsir.cn/usr/uploads/2022/10/938684637.jpeg
 [2]: https://xwsir.cn/usr/uploads/2022/10/1126482411.jpeg
 [3]: https://xwsir.cn/usr/uploads/2022/10/80576426.jpeg
 [4]: https://xwsir.cn/usr/uploads/2022/10/1088641275.jpeg
 [5]: https://xwsir.cn/usr/uploads/2022/10/3691610397.jpeg