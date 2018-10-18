set names utf8;

create table if not exists t_guild
(
	guild_id int unsigned not null comment '军团id',
	guild_name varchar(32) not null comment '军团名称',
	guild_level	tinyint unsigned not null comment '军团等级',
	guild_icon int unsigned not null default 1 comment '军团徽章',
	fight_force int unsigned not null comment '军团战斗力', 
	upgrade_time int unsigned not null comment '升级时间',
	create_uid int unsigned not null comment '创建者id',
	create_time int unsigned not null comment '创建时间',
	join_num smallint unsigned not null comment '加入人数，每日重置',
	join_time int unsigned not null comment '加入时间',
	contri_num smallint unsigned not null comment '贡献次数，每日重置',
	contri_time	int unsigned not null comment '贡献时间',
	reward_num smallint unsigned not null comment '领奖次数，每日重置',
	reward_time	int unsigned not null comment '领奖次数重置时间',
	grain_num int unsigned not null comment '粮草数量',
	attack_num int unsigned not null comment '抢粮次数',
	defend_num int unsigned not null comment '防守次数', 
	robnum_rfrtime int unsigned not null comment '军团抢粮次数重置时间', 
	refresh_num int unsigned not null comment '刷新次数，每日重置',
	refresh_num_byexp int unsigned not null comment '军团建设度刷新次数，每日重置',
	rfrnum_rfrtime int unsigned not null comment '刷新次数重置时间',
	fight_book int unsigned not null comment '战书数量',
	fightbook_rfrtime int unsigned not null comment '战书数量重置时间',
	curr_exp int unsigned not null comment '当前建设度',
	share_cd int unsigned not null comment '分粮冷却时间',
	status tinyint unsigned not null comment '状态,1正常,0删除',
	va_info	blob not null comment '军团信息,array{
	  0=>{slogan(宣言),post(公告),passwd(密码),
	      goods(商品)=>{$goodsId(商品id)=>{sum(总数),time(时间)}},
		  refresh_list(刷新列表)=>{$goodsId,$goodsId,$goodsId},
		  refresh_cd(刷新时间)},
	  1(军团大厅)=>{level(等级),allExp(总经验)},
	  2(关公殿)=>{level(等级),allExp(总经验)},
	  3(商城)=>{level(等级),allExp(总经验)},
	  4(副本)=>{level(等级),allExp(总经验)},
	  5(任务)=>{level(等级),allExp(总经验)}, 
	  6(粮仓)=>{level(等级),allExp(总经验),fields=>{$id(粮田)=>{$exp(经验),$level(等级)}},time($level=>$time)}},
	  7(科技)=>{level(等级),allExp(总经验),skills=>{$id(技能)=>$level}}',
	
	primary key(guild_id),
	unique key guild_name(guild_name),
	index fight_force(fight_force)
)engine = InnoDb default charset utf8;