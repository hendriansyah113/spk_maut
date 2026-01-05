<?php $this->load->view('layouts/header_admin'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-edit"></i> Data Penilaian</h1>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
	<!-- /.card-header -->
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Penilaian</h6>
	</div>
	<form method="get" action="<?= base_url('Penilaian') ?>" class="mt-3 ml-4">
		<div class="row">
			<div class="col-md-4">
				<select name="bulan" class="form-control">
					<option value="">-- Pilih Bulan --</option>
					<?php
					$bulan = [
						1 => 'Januari',
						2 => 'Februari',
						3 => 'Maret',
						4 => 'April',
						5 => 'Mei',
						6 => 'Juni',
						7 => 'Juli',
						8 => 'Agustus',
						9 => 'September',
						10 => 'Oktober',
						11 => 'November',
						12 => 'Desember'
					];
					$bulan_pilih = $this->input->get('bulan') ?? date('n');
					foreach ($bulan as $k => $v):
					?>
						<option value="<?= $k ?>" <?= ($k == $bulan_pilih) ? 'selected' : '' ?>>
							<?= $v ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="col-md-3">
				<input type="number" name="tahun" class="form-control"
					value="<?= $this->input->get('tahun') ?? date('Y') ?>">
			</div>

			<div class="col-md-2">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-search"></i> Tampilkan
				</button>
			</div>
		</div>
	</form>


	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Alternatif</th>
						<?php foreach ($kriteria as $k): ?>
							<th><?= $k->keterangan ?></th>
						<?php endforeach; ?>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					<?php foreach ($alternatif as $alt): ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $alt->nama ?></td>

							<?php foreach ($kriteria as $k): ?>
								<?php
								$nilai = $this->Penilaian_model
									->data_penilaian($alt->id_alternatif, $k->id_kriteria, $bulan_pilih, $tahun);

								$sub = $nilai
									? $this->Penilaian_model->get_sub_kriteria_by_id($nilai['nilai'])
									: null;
								?>
								<td>
									<?= $sub ? $sub['deskripsi'] : '-' ?>
								</td>
							<?php endforeach; ?>

							<?php $cek_tombol = $this->Penilaian_model->untuk_tombol($alt->id_alternatif, $bulan_pilih, $tahun); ?>
							<td>
								<?php if ($cek_tombol == 0) { ?>
									<a data-toggle="modal" href="#set<?= $alt->id_alternatif ?>"
										class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Input</a>
								<?php } else { ?>
									<a data-toggle="modal" href="#edit<?= $alt->id_alternatif ?>"
										class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
								<?php } ?>
							</td>
						</tr>

						<!-- Modal -->
						<div class="modal fade" id="edit<?= $alt->id_alternatif ?>" tabindex="-1" role="dialog"
							aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Penilaian
										</h5>
										<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">&times;</button>
									</div>
									<?= form_open('Penilaian/update_penilaian') ?>
									<div class="modal-body">
										<?php foreach ($kriteria as $key): ?>
											<?php
											$sub_kriteria = $this->Penilaian_model->data_sub_kriteria($key->id_kriteria);
											?>
											<?php if ($sub_kriteria != NULL): ?>
												<input type="text" name="id_alternatif" value="<?= $alt->id_alternatif ?>" hidden>
												<input type="text" name="id_kriteria[]" value="<?= $key->id_kriteria ?>" hidden>
												<input type="hidden" name="bulan" value="<?= $bulan_pilih ?>">
												<input type="hidden" name="tahun" value="<?= $tahun ?>">
												<div class="form-group">
													<label class="font-weight-bold"
														for="<?= $key->id_kriteria ?>"><?= $key->keterangan ?></label>
													<select name="nilai[]" class="form-control" id="<?= $key->id_kriteria ?>"
														required>
														<option value="">--Pilih--</option>
														<?php
														$nilai = $this->Penilaian_model
															->data_penilaian($alt->id_alternatif, $key->id_kriteria, $bulan_pilih, $tahun);
														$nilai_terpilih = $nilai ? $nilai['nilai'] : null;
														?>

														<?php foreach ($sub_kriteria as $subs_kriteria): ?>
															<option value="<?= $subs_kriteria['id_sub_kriteria'] ?>"
																<?= ($subs_kriteria['id_sub_kriteria'] == $nilai_terpilih) ? 'selected' : '' ?>>
																<?= $subs_kriteria['deskripsi'] ?>
															</option>
														<?php endforeach ?>

													</select>
												</div>
											<?php endif ?>
										<?php endforeach ?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning" data-dismiss="modal"><i
												class="fa fa-times"></i> Batal</button>
										<button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
											Update</button>
									</div>
									</form>
								</div>
							</div>
						</div>

						<!-- Modal tambah -->
						<div class="modal fade" id="set<?= $alt->id_alternatif ?>" tabindex="-1" role="dialog"
							aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Input Penilaian
										</h5>
										<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">&times;</button>
									</div>
									<?= form_open('Penilaian/tambah_penilaian') ?>
									<input type="hidden" name="bulan" value="<?= $bulan_pilih ?>">
									<input type="hidden" name="tahun" value="<?= $tahun ?>">
									<div class="modal-body">
										<?php foreach ($kriteria as $key): ?>
											<?php
											$sub_kriteria = $this->Penilaian_model->data_sub_kriteria($key->id_kriteria);
											?>
											<?php if ($sub_kriteria != NULL): ?>
												<input type="text" name="id_alternatif" value="<?= $alt->id_alternatif ?>" hidden>
												<input type="text" name="id_kriteria[]" value="<?= $key->id_kriteria ?>" hidden>
												<div class="form-group">
													<label class="font-weight-bold"
														for="<?= $key->id_kriteria ?>"><?= $key->keterangan ?></label>
													<select name="nilai[]" class="form-control" id="<?= $key->id_kriteria ?>"
														required>
														<option value="">--Pilih--</option>
														<?php foreach ($sub_kriteria as $subs_kriteria): ?>
															<option value="<?= $subs_kriteria['id_sub_kriteria'] ?>">
																<?= $subs_kriteria['deskripsi'] ?> </option>
														<?php endforeach ?>
													</select>
												</div>
											<?php endif ?>
										<?php endforeach ?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-warning" data-dismiss="modal"><i
												class="fa fa-times"></i> Batal</button>
										<button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
											Simpan</button>
									</div>
									</form>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

				</tbody>
			</table>
		</div>
	</div>

	<?php $this->load->view('layouts/footer_admin'); ?>