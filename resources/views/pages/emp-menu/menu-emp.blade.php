<ul class="nav nav-tabs" id="employeeTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="../employee/add-employee.php" class="nav-link link-dark">
            <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true">بيانات الشخصية</button>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="../emp-family/add-family.php" class="nav-link link-dark">
            <button class="nav-link" id="family-tab" data-bs-toggle="tab" data-bs-target="#family" type="button" role="tab" aria-controls="family" aria-selected="false">بيانات عائلية</button>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="../emp-emergency/add-emergency.php" class="nav-link link-dark">
            <button class="nav-link" id="emergency-tab" data-bs-toggle="tab" data-bs-target="#emergency" type="button" role="tab" aria-controls="emergency" aria-selected="false">بيانات الطوارئ</button>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="emp-docs.php?emp_id=<?php echo $emp_id; ?>" class="nav-link link-dark">
            <button class="nav-link" id="docs-tab" data-bs-toggle="tab" data-bs-target="#docs" type="button" role="tab" aria-controls="docs" aria-selected="false">المستندات</button>
        </a>
    </li>
</ul>
