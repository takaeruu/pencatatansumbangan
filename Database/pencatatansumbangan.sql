/*
 Navicat Premium Data Transfer

 Source Server         : yoga
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : pencatatansumbangan

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 21/11/2024 21:18:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for donasi
-- ----------------------------
DROP TABLE IF EXISTS `donasi`;
CREATE TABLE `donasi`  (
  `id_donasi` int NOT NULL AUTO_INCREMENT,
  `id_program` int NULL DEFAULT NULL,
  `nama_pemberi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah_donasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_donasi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of donasi
-- ----------------------------
INSERT INTO `donasi` VALUES (2, 1, 'RPL XII B', '200000000', '2024-11-20', NULL, NULL);
INSERT INTO `donasi` VALUES (3, 2, 'RPL XII BBBB', '300000000', '2024-11-20', NULL, NULL);
INSERT INTO `donasi` VALUES (4, 1, 'RPL XII A', '20', '2024-11-20', NULL, NULL);
INSERT INTO `donasi` VALUES (11, 8, 'RPL XII C', '200000', '2024-11-21', NULL, NULL);

-- ----------------------------
-- Table structure for program
-- ----------------------------
DROP TABLE IF EXISTS `program`;
CREATE TABLE `program`  (
  `id_program` int NOT NULL AUTO_INCREMENT,
  `nama_program` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `donasi_terkumpul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_program`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program
-- ----------------------------
INSERT INTO `program` VALUES (1, 'TEST123', '2024-11-20', '21', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `program` VALUES (2, 'TEST2', NULL, NULL, 1, '2024-11-21 06:18:19', NULL, NULL, NULL, NULL);
INSERT INTO `program` VALUES (8, 'Donasi Murid', '2024-11-21', '200000', 1, '2024-11-21 07:33:22', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for program_backup
-- ----------------------------
DROP TABLE IF EXISTS `program_backup`;
CREATE TABLE `program_backup`  (
  `id_program` int NOT NULL AUTO_INCREMENT,
  `nama_program` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `donasi_terkumpul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_program`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program_backup
-- ----------------------------
INSERT INTO `program_backup` VALUES (2, 'TEST2', NULL, NULL, NULL, NULL);
INSERT INTO `program_backup` VALUES (3, 'Donasi Bencana', NULL, NULL, NULL, NULL);
INSERT INTO `program_backup` VALUES (4, 'Donasi Murid', NULL, NULL, NULL, NULL);
INSERT INTO `program_backup` VALUES (6, 'Donasi Guru', NULL, NULL, NULL, NULL);
INSERT INTO `program_backup` VALUES (7, 'Donasi Untuk Kepala Sekolah', NULL, NULL, NULL, NULL);
INSERT INTO `program_backup` VALUES (8, 'Donasi Murid', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `logo_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tab_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `login_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'Permata Harapan School', '1732196113_4624590d70bb76ff318f.png', '1732196104_c6985b22ee789e653155.png', '1732196104_a3279783434c1cee5e93.png', NULL, 1, NULL, NULL, '2024-11-21 07:35:13', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` enum('admin','petugas','masyarakat') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (2, 'petugas', 'c4ca4238a0b923820dcc509a6f75849b', 'petugas', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for user_activity
-- ----------------------------
DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity`  (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `time` datetime NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 883 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_activity
-- ----------------------------
INSERT INTO `user_activity` VALUES (688, '1', 'Masuk ke Log Activity', '2024-11-21 06:11:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (689, '1', 'Masuk ke Dashboard', '2024-11-21 06:11:37', NULL, NULL);
INSERT INTO `user_activity` VALUES (690, '1', 'Masuk ke Log Activity', '2024-11-21 06:11:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (691, '1', 'Masuk ke ', '2024-11-21 06:13:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (692, '1', 'Masuk ke Donasi', '2024-11-21 06:13:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (693, '1', 'Masuk ke Donasi', '2024-11-21 06:17:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (694, '1', 'Masuk ke ', '2024-11-21 06:17:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (695, '1', 'Masuk ke ', '2024-11-21 06:17:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (696, '1', 'Masuk ke ', '2024-11-21 06:18:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (697, '1', 'Masuk ke ', '2024-11-21 06:34:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (698, '1', 'Masuk ke Restore Edit Program', '2024-11-21 06:34:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (699, '1', 'Masuk ke Restore Edit Program', '2024-11-21 06:34:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (700, '1', 'Masuk ke Restore Edit Program', '2024-11-21 06:34:37', NULL, NULL);
INSERT INTO `user_activity` VALUES (701, '1', 'Masuk ke Restore Edit Program', '2024-11-21 06:38:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (702, '1', 'Masuk ke Restore Edit Program', '2024-11-21 06:39:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (703, '1', 'Masuk ke Restore Edit Program', '2024-11-21 06:39:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (704, '1', 'Masuk ke ', '2024-11-21 06:39:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (705, '1', 'Masuk ke ', '2024-11-21 06:44:00', NULL, NULL);
INSERT INTO `user_activity` VALUES (706, '1', 'Masuk ke ', '2024-11-21 06:44:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (707, '1', 'Masuk ke Donasi', '2024-11-21 06:44:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (708, '1', 'Masuk ke Donasi', '2024-11-21 06:44:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (709, '1', 'Masuk ke Donasi', '2024-11-21 06:44:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (710, '1', 'Masuk ke Donasi', '2024-11-21 06:45:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (711, '1', 'Masuk ke Donasi', '2024-11-21 06:45:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (712, '1', 'Masuk ke Donasi', '2024-11-21 06:46:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (713, '1', 'Masuk ke Donasi', '2024-11-21 06:46:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (714, '1', 'Masuk ke Donasi', '2024-11-21 06:46:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (715, '1', 'Masuk ke Donasi', '2024-11-21 06:52:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (716, '1', 'Masuk ke Soft Delete', '2024-11-21 06:52:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (717, '1', 'Masuk ke Soft Delete', '2024-11-21 06:52:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (718, '1', 'Masuk ke Soft Delete', '2024-11-21 06:54:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (719, '1', 'Masuk ke Soft Delete', '2024-11-21 06:54:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (720, '1', 'Masuk ke Soft Delete', '2024-11-21 06:54:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (721, '1', 'Masuk ke Soft Delete', '2024-11-21 06:55:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (722, '1', 'Masuk ke Donasi', '2024-11-21 06:55:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (723, '1', 'Masuk ke Donasi', '2024-11-21 06:55:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (724, '1', 'Masuk ke Setting', '2024-11-21 06:55:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (725, '1', 'Masuk ke Soft Delete', '2024-11-21 06:55:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (726, '1', 'Masuk ke Soft Delete', '2024-11-21 06:55:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (727, '1', 'Masuk ke Restore Edit Program', '2024-11-21 06:55:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (728, '1', 'Masuk ke Restore Edit Program', '2024-11-21 06:55:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (729, '1', 'Masuk ke Log Activity', '2024-11-21 06:55:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (730, '1', 'Masuk ke Log Activity', '2024-11-21 06:55:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (731, '1', 'Masuk ke ', '2024-11-21 06:55:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (732, '1', 'Masuk ke Dashboard', '2024-11-21 06:56:00', NULL, NULL);
INSERT INTO `user_activity` VALUES (733, '1', 'Masuk ke Dashboard', '2024-11-21 06:56:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (734, '1', 'Masuk ke Dashboard', '2024-11-21 06:56:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (735, '1', 'Masuk ke Dashboard', '2024-11-21 06:58:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (736, '1', 'Masuk ke Setting', '2024-11-21 06:58:39', NULL, NULL);
INSERT INTO `user_activity` VALUES (737, '1', 'Masuk ke Soft Delete', '2024-11-21 06:58:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (738, '1', 'Masuk ke Restore Edit Program', '2024-11-21 06:58:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (739, '1', 'Masuk ke Restore Edit Program', '2024-11-21 06:59:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (740, '1', 'Masuk ke Restore Edit Program', '2024-11-21 07:00:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (741, '1', 'Masuk ke ', '2024-11-21 07:00:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (742, '1', 'Masuk ke ', '2024-11-21 07:00:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (743, '1', 'Masuk ke Dashboard', '2024-11-21 07:00:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (744, '1', 'Masuk ke Login', '2024-11-21 07:01:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (745, '1', 'Masuk ke Login', '2024-11-21 07:01:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (746, '1', 'Masuk ke Dashboard', '2024-11-21 07:01:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (747, '1', 'Masuk ke ', '2024-11-21 07:01:40', NULL, NULL);
INSERT INTO `user_activity` VALUES (748, '1', 'Masuk ke ', '2024-11-21 07:01:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (749, '1', 'Masuk ke ', '2024-11-21 07:02:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (750, '1', 'Masuk ke Donasi', '2024-11-21 07:02:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (751, '1', 'Masuk ke Donasi', '2024-11-21 07:02:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (752, '1', 'Masuk ke ', '2024-11-21 07:02:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (753, '1', 'Masuk ke ', '2024-11-21 07:02:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (754, '1', 'Masuk ke Donasi', '2024-11-21 07:02:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (755, '1', 'Masuk ke Donasi', '2024-11-21 07:02:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (756, '1', 'Masuk ke Donasi', '2024-11-21 07:03:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (757, '1', 'Masuk ke Donasi', '2024-11-21 07:04:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (758, '1', 'Masuk ke Donasi', '2024-11-21 07:05:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (759, '1', 'Masuk ke Donasi', '2024-11-21 07:05:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (760, '1', 'Masuk ke Donasi', '2024-11-21 07:05:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (761, '1', 'Masuk ke Donasi', '2024-11-21 07:05:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (762, '1', 'Masuk ke Donasi', '2024-11-21 07:05:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (763, '1', 'Masuk ke ', '2024-11-21 07:05:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (764, '1', 'Masuk ke ', '2024-11-21 07:05:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (765, '1', 'Masuk ke ', '2024-11-21 07:05:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (766, '1', 'Masuk ke Dashboard', '2024-11-21 07:05:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (767, '1', 'Masuk ke Login', '2024-11-21 07:05:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (768, '1', 'Masuk ke Login', '2024-11-21 07:05:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (769, '1', 'Masuk ke Dashboard', '2024-11-21 07:05:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (770, '1', 'Masuk ke ', '2024-11-21 07:05:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (771, '1', 'Masuk ke ', '2024-11-21 07:05:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (772, '1', 'Masuk ke Login', '2024-11-21 07:07:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (773, '1', 'Masuk ke Login', '2024-11-21 07:07:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (774, '1', 'Masuk ke Login', '2024-11-21 07:07:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (775, '1', 'Masuk ke Dashboard', '2024-11-21 07:08:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (776, '1', 'Masuk ke ', '2024-11-21 07:08:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (777, '1', 'Masuk ke ', '2024-11-21 07:08:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (778, '1', 'Masuk ke ', '2024-11-21 07:08:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (779, '1', 'Masuk ke ', '2024-11-21 07:08:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (780, '1', 'Masuk ke ', '2024-11-21 07:08:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (781, '1', 'Masuk ke Donasi', '2024-11-21 07:08:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (782, '1', 'Masuk ke Donasi', '2024-11-21 07:09:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (783, '1', 'Masuk ke Donasi', '2024-11-21 07:09:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (784, '1', 'Masuk ke Donasi', '2024-11-21 07:09:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (785, '1', 'Masuk ke Login', '2024-11-21 07:10:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (786, '1', 'Masuk ke Dashboard', '2024-11-21 07:10:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (787, '1', 'Masuk ke ', '2024-11-21 07:10:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (788, '1', 'Masuk ke ', '2024-11-21 07:10:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (789, '1', 'Masuk ke ', '2024-11-21 07:10:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (790, '1', 'Masuk ke Donasi', '2024-11-21 07:10:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (791, '1', 'Masuk ke Donasi', '2024-11-21 07:11:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (792, '1', 'Masuk ke ', '2024-11-21 07:11:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (793, '1', 'Masuk ke Donasi', '2024-11-21 07:11:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (794, '1', 'Masuk ke Donasi', '2024-11-21 07:13:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (795, '1', 'Masuk ke Donasi', '2024-11-21 07:14:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (796, '1', 'Masuk ke Donasi', '2024-11-21 07:14:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (797, '1', 'Masuk ke Donasi', '2024-11-21 07:14:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (798, '1', 'Masuk ke Donasi', '2024-11-21 07:14:40', NULL, NULL);
INSERT INTO `user_activity` VALUES (799, '1', 'Masuk ke Donasi', '2024-11-21 07:16:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (800, '1', 'Masuk ke Donasi', '2024-11-21 07:16:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (801, '1', 'Masuk ke Donasi', '2024-11-21 07:16:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (802, '1', 'Masuk ke Donasi', '2024-11-21 07:19:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (803, '1', 'Masuk ke Donasi', '2024-11-21 07:19:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (804, '1', 'Masuk ke Donasi', '2024-11-21 07:19:38', NULL, NULL);
INSERT INTO `user_activity` VALUES (805, '1', 'Masuk ke Donasi', '2024-11-21 07:19:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (806, '1', 'Masuk ke ', '2024-11-21 07:19:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (807, '1', 'Masuk ke Donasi', '2024-11-21 07:19:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (808, '1', 'Masuk ke Donasi', '2024-11-21 07:19:55', NULL, NULL);
INSERT INTO `user_activity` VALUES (809, '1', 'Masuk ke ', '2024-11-21 07:19:56', NULL, NULL);
INSERT INTO `user_activity` VALUES (810, '1', 'Masuk ke Donasi', '2024-11-21 07:19:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (811, '1', 'Masuk ke Donasi', '2024-11-21 07:19:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (812, '1', 'Masuk ke Donasi', '2024-11-21 07:20:36', NULL, NULL);
INSERT INTO `user_activity` VALUES (813, '1', 'Masuk ke Donasi', '2024-11-21 07:21:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (814, '1', 'Masuk ke Donasi', '2024-11-21 07:21:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (815, '1', 'Masuk ke Donasi', '2024-11-21 07:21:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (816, '1', 'Masuk ke Dashboard', '2024-11-21 07:21:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (817, '1', 'Masuk ke Login', '2024-11-21 07:21:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (818, '1', 'Masuk ke Dashboard', '2024-11-21 07:21:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (819, '1', 'Masuk ke Login', '2024-11-21 07:21:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (820, '1', 'Masuk ke Dashboard', '2024-11-21 07:23:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (821, '1', 'Masuk ke ', '2024-11-21 07:23:19', NULL, NULL);
INSERT INTO `user_activity` VALUES (822, '1', 'Masuk ke ', '2024-11-21 07:23:52', NULL, NULL);
INSERT INTO `user_activity` VALUES (823, '1', 'Masuk ke ', '2024-11-21 07:23:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (824, '1', 'Masuk ke Donasi', '2024-11-21 07:24:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (825, '1', 'Masuk ke Donasi', '2024-11-21 07:24:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (826, '1', 'Masuk ke ', '2024-11-21 07:24:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (827, '1', 'Masuk ke Donasi', '2024-11-21 07:24:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (828, '1', 'Masuk ke Donasi', '2024-11-21 07:24:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (829, '1', 'Masuk ke ', '2024-11-21 07:24:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (830, '1', 'Masuk ke Donasi', '2024-11-21 07:24:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (831, '1', 'Masuk ke Donasi', '2024-11-21 07:24:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (832, '1', 'Masuk ke Donasi', '2024-11-21 07:24:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (833, '1', 'Masuk ke Donasi', '2024-11-21 07:25:03', NULL, NULL);
INSERT INTO `user_activity` VALUES (834, '1', 'Masuk ke Setting', '2024-11-21 07:25:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (835, '1', 'Masuk ke Setting', '2024-11-21 07:25:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (836, '1', 'Masuk ke Setting', '2024-11-21 07:25:46', NULL, NULL);
INSERT INTO `user_activity` VALUES (837, '1', 'Masuk ke Soft Delete', '2024-11-21 07:25:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (838, '1', 'Masuk ke Soft Delete', '2024-11-21 07:25:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (839, '1', 'Masuk ke Soft Delete', '2024-11-21 07:25:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (840, '1', 'Masuk ke Donasi', '2024-11-21 07:25:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (841, '1', 'Masuk ke Donasi', '2024-11-21 07:25:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (842, '1', 'Masuk ke Donasi', '2024-11-21 07:26:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (843, '1', 'Masuk ke Soft Delete', '2024-11-21 07:26:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (844, '1', 'Masuk ke Soft Delete', '2024-11-21 07:26:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (845, '1', 'Masuk ke Donasi', '2024-11-21 07:26:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (846, '1', 'Masuk ke ', '2024-11-21 07:26:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (847, '1', 'Masuk ke Restore Edit Program', '2024-11-21 07:26:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (848, '1', 'Masuk ke ', '2024-11-21 07:26:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (849, '1', 'Masuk ke Log Activity', '2024-11-21 07:26:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (850, NULL, 'Masuk ke Login', '2024-11-21 07:26:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (851, NULL, 'Masuk ke Login', '2024-11-21 07:32:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (852, '1', 'Masuk ke Dashboard', '2024-11-21 07:33:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (853, '1', 'Masuk ke ', '2024-11-21 07:33:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (854, '1', 'Masuk ke ', '2024-11-21 07:33:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (855, '1', 'Masuk ke ', '2024-11-21 07:33:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (856, '1', 'Masuk ke Donasi', '2024-11-21 07:33:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (857, '1', 'Masuk ke Donasi', '2024-11-21 07:33:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (858, '1', 'Masuk ke Donasi', '2024-11-21 07:33:51', NULL, NULL);
INSERT INTO `user_activity` VALUES (859, '1', 'Masuk ke ', '2024-11-21 07:33:53', NULL, NULL);
INSERT INTO `user_activity` VALUES (860, '1', 'Masuk ke ', '2024-11-21 07:33:54', NULL, NULL);
INSERT INTO `user_activity` VALUES (861, '1', 'Masuk ke Donasi', '2024-11-21 07:33:57', NULL, NULL);
INSERT INTO `user_activity` VALUES (862, '1', 'Masuk ke Donasi', '2024-11-21 07:34:09', NULL, NULL);
INSERT INTO `user_activity` VALUES (863, '1', 'Masuk ke ', '2024-11-21 07:34:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (864, '1', 'Masuk ke ', '2024-11-21 07:34:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (865, '1', 'Masuk ke Donasi', '2024-11-21 07:34:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (866, '1', 'Masuk ke Donasi', '2024-11-21 07:34:21', NULL, NULL);
INSERT INTO `user_activity` VALUES (867, '1', 'Masuk ke Donasi', '2024-11-21 07:34:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (868, '1', 'Masuk ke Setting', '2024-11-21 07:34:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (869, '1', 'Masuk ke Setting', '2024-11-21 07:35:04', NULL, NULL);
INSERT INTO `user_activity` VALUES (870, '1', 'Masuk ke Setting', '2024-11-21 07:35:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (871, '1', 'Masuk ke Soft Delete', '2024-11-21 07:35:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (872, '1', 'Masuk ke Donasi', '2024-11-21 07:35:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (873, '1', 'Masuk ke Donasi', '2024-11-21 07:35:23', NULL, NULL);
INSERT INTO `user_activity` VALUES (874, '1', 'Masuk ke Donasi', '2024-11-21 07:35:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (875, '1', 'Masuk ke Soft Delete', '2024-11-21 07:35:31', NULL, NULL);
INSERT INTO `user_activity` VALUES (876, '1', 'Masuk ke Soft Delete', '2024-11-21 07:35:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (877, '1', 'Masuk ke Donasi', '2024-11-21 07:35:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (878, '1', 'Masuk ke Restore Edit Program', '2024-11-21 07:35:37', NULL, NULL);
INSERT INTO `user_activity` VALUES (879, '1', 'Masuk ke ', '2024-11-21 07:35:42', NULL, NULL);
INSERT INTO `user_activity` VALUES (880, '1', 'Masuk ke Log Activity', '2024-11-21 07:35:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (881, '1', 'Masuk ke Log Activity', '2024-11-21 07:36:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (882, NULL, 'Masuk ke Login', '2024-11-21 07:36:10', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
