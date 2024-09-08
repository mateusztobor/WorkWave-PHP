<?php
	if(Flight::isAuthorized('logged') && !Flight::isAuthorized('b')) {
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'courses.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadCourses.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'course.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadSections.php';
		require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'section.php';
		if(Flight::isAuthorized('t')) {
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'coursesTrainer.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadTrainerCourses.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'createCourse.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'courseTrainer.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadTrainerSections.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'sectionTrainer.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'addSection.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'updateCourseName.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'updateSectionName.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'deleteCourse.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'deleteSection.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'updateSectionContent.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'members.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadMembers.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'memberDecision.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'uploadCourseImage.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'loadCourseImage.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'delegateAdmin.php';
			require __DIR__.DIRECTORY_SEPARATOR.'inc'.DIRECTORY_SEPARATOR.'moveSection.php';
		}
	}