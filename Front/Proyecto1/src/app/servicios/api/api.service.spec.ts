import { TestBed } from '@angular/core/testing';

import {ApiServicen } from './api.service';

describe('ApiService', () => {
  let service: ApiServicen;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ApiServicen);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
