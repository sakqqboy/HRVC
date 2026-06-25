-- A6: kgiWeighId -> kgiWeightId
ALTER TABLE employee_kgi_evaluation
  CHANGE COLUMN kgiWeighId kgiWeightId bigint(20) NOT NULL;

-- A7: acessId -> accessId (PRIMARY KEY)
ALTER TABLE user_access
  CHANGE COLUMN acessId accessId bigint(20) NOT NULL AUTO_INCREMENT;

-- A8: unique constraint on username
ALTER TABLE `user`
  ADD UNIQUE KEY uk_username (username);

-- D7: level6End bigint -> decimal
ALTER TABLE kfi_weight
  MODIFY COLUMN level6End DECIMAL(10,4);
